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
    /* the url for grab problem infomation */
    private $grabUrl = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';

    /* the rule for grab problem information */
    private $rules = [
        'title'=>['h1', 'text'],
        'head' => ['.panel_title','text'],
        'content' => ['.panel_content','html'],
    ];

    /**
     * Problem infomation format for front end
     *
     * @param array $array
     * @return mixed
     */
    public function infoFormat(Array $array)
    {
        $problem['title'] = reset($array)['title'];

        $relation=[
          'Problem Description'=>'description',
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

    /**
     * Grab problem infomation
     *
     * @param $id
     * @return mixed
     */
    public function grabProblem($id)
    {
        $url = sprintf($this->grabUrl, $id);

        $content = \QL\QueryList::Query($url,$this->rules,'','UTF-8','GB2312',true)->data;

        $info = $this->infoFormat($content);
        $info['id'] = $id;

        return $info;
    }
}