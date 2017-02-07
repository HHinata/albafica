<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午7:33
 */
namespace App\Services;

use App\Contracts\PlatformContract;

class POJService implements PlatformContract
{
    private $url = 'http://poj.org/problem?id=%d';

    private $rules = [
        'title'=>['.ptt', 'text'],
        'head' => ['.pst','text'],
        'content_ptx' => ['.ptx','html'],
        'content_sio' => ['.sio','html'],
    ];

    public function infoFormat(Array $array)
    {
        $problem['title'] = reset($array)['title'];

        $relation=[
            'Description'=>'content',
            'Input'   =>  'input',
            'Output'  =>  'output',
            'Sample Input'    =>  'sample_input',
            'Sample Output'   =>  'sample_output',
            'Author'    =>  'author',
            'Recommend' =>  'recommend',
            'Source'    =>  'source',
            'Hint'  =>  'hint',
        ];

        foreach ($array as $item)
        {
            if (isset($item['content_ptx']))    $problem[$relation[$item['head']]] = $item['content_ptx'];
            else if(isset($item['content_sio']))
            {
                $problem[$relation[$item['head']]] = '<pre>'.$item['content_sio'].'</pre>';
            }
        }

        return $problem;
    }

    public function grabProblem($id)
    {
        $page = sprintf($this->url, $id);

        $content = \QL\QueryList::Query($page,$this->rules)->data;

        $info = $this->infoFormat($content);
        $info['id'] = $id;

        return $info;
    }

    public function submit($id, $lang, $code)
    {

    }

    public function login()
    {
        // TODO: Implement login() method.
    }
}