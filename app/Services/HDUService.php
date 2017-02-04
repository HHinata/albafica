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
    private $url = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';

    private $rules = [
        'title'=>['h1', 'text'],
        'head' => ['.panel_title','text'],
        'content' => ['.panel_content','html'],
    ];

    private function dataHandle(Array $array)
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

    public function obtainContent($id)
    {
        $page = sprintf($this->url, $id);

        $data = \QL\QueryList::Query($page,$this->rules,'','UTF-8','GB2312',true)->data;

        $data = $this->dataHandle($data);

        $data['id'] = $id;

        return $data;
    }

    public function submit($id, $lang, $code)
    {

    }
}