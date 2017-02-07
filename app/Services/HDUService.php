<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午7:32
 */
namespace App\Services;

use App\Contracts\PlatformContract;

class HDUService implements PlatformContract
{
    /* the configure for submit code and get solution */
    private $config = [];

    /* the login status */
    private $isLogin = false;

    /* the client for http request */
    private $client = null;

    /* the url for login website */
    private $loginUrl = 'http://acm.hdu.edu.cn/userloginex.php?action=login';

    /* the url for submit code*/
    private $submitUrl = 'http://acm.hdu.edu.cn/submit.php?action=submit';

    /* the table for language convert */
    private $langTable = ['g++'=>'0'];

    /* the url for grab problem infomation */
    private $grabUrl = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';

    /* the rule for grab problem information */
    private $rules = [
        'title'=>['h1', 'text'],
        'head' => ['.panel_title','text'],
        'content' => ['.panel_content','html'],
    ];

    public function infoFormat(Array $array)
    {
        $problem['title'] = reset($array)['title'];

        $relation=[
          'Problem Description'=>'content',
          'Input'   =>  'input',
          'Output'  =>  'output',
          'Sample Input'    =>  'sample_input',
          'Sample Output'   =>  'sample_output',
          'Author'   =>  'author',
          'Recommend'   =>  'recommend',
          'Source'      =>  'source',
        ];

        foreach ($array as $item)
        {
            $problem[$relation[$item['head']]] = $item['content'];
        }

        return $problem;
    }

    public function grabProblem($id)
    {
        $page = sprintf($this->grabUrl, $id);

        $content = \QL\QueryList::Query($page,$this->rules,'','UTF-8','GB2312',true)->data;

        $info = $this->infoFormat($content);
        $info['id'] = $id;

        return $info;
    }

    public function __construct($config = null)
    {
        if (is_null($config))
        {
            $this->config['user'] = env('HDU_USER');
            $this->config['pass'] = env('HDU_PASS');
        }
        else    $this->config = $config;

        $this->client = new \GuzzleHttp\Client(['cookies' => true]);
    }

    /**
     * Submit code to HDU Open Judge
     *
     * @param $id
     * @param $lang
     * @param $code
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function submit($id, $lang, $code)
    {
        if ($this->isLogin === false)
        {
            $this->login();
        }

        $data = ['check'=>0, 'problemid'=>$id, 'language'=>$this->langTable[$lang], 'usercode'=>$code];

        $res = $this->client->request('POST', $this->submitUrl, ['form_params'=>$data]);

        return $res;
    }

    /**
     * Login HDU Open Judge
     */
    public function login()
    {
        // TODO: Implement login() method.

        $data = [
            'username' => $this->config['user'],
            'userpass' => $this->config['pass'],
            'login' => 'Sign In'
            ];

        $this->client->request('POST', $this->loginUrl, ['form_params'=>$data]);

        $this->isLogin = true;
    }
}