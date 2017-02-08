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

    /* the solution list url */
    private $solutionUrl = 'http://acm.hdu.edu.cn/status.php?first=%d&pid=%d&user=%s&lang=%d&status=%d';

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
        $url = sprintf($this->grabUrl, $id);

        $content = \QL\QueryList::Query($url,$this->rules,'','UTF-8','GB2312',true)->data;

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

        $this->client->request('POST', $this->submitUrl, ['form_params'=>$data]);

        $rid = self::getRID($id);

        return $rid;
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

    /**
     * Get the run id in the Open Judge
     *
     * @param $pid
     * @param $first
     * @param $lang
     * @param $status
     */
    public function getRID(int $pid, int $first=0, int $lang=0, int $status=0)
    {
        if ($this->isLogin === false)
        {
            $this->login();
        }

        $username = $this->config['user']?:"";

        $url = sprintf($this->solutionUrl, $first, $pid, $username, $lang, $status);

        $rules = [
            'title'=>['td[height=22px]', 'text']
        ];

        $content = \QL\QueryList::Query($url,$rules,'','UTF-8','GB2312',true)->data;

        return reset($content)['title'];
    }
}