<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午7:32
 */
namespace App\Services;

use App\Contracts\PlatformContract;

class POJService implements PlatformContract
{
    use JudgeTrait;

    function __construct()
    {
        $this->grabUrl = 'http://poj.org/problem?id=%d';

        $this->rules = [
            'title'=>"{<div class=\"ptt\" lang=\"en-US\">([\\s\\S]*?)</div>}",
            'description'=>"{<p class=\"pst\">Description</p>([\\s\\S]*?)<p class=\"pst\"}",
            'input'=>"{<p class=\"pst\">Input</p>([\\s\\S]*?)<p class=\"pst\"}",
            'output'=>"{<p class=\"pst\">Output</p>([\\s\\S]*?)<p class=\"pst\"}",
            'sample_input'=>"{<p class=\"pst\">Sample Input</p>([\\s\\S]*?)<p class=\"pst\"}",
            'sample_output'=>"{<p class=\"pst\">Sample Output</p>([\\s\\S]*?)<p class=\"pst\"}",
            'source'=>"{<p class=\"pst\">Source</p>([\\s\\S]*?)<p class=\"pst\"}",
        ];

        $this->grabMethod = "regular";
    }

    /**
     * Grab problem infomation
     *
     * @param $id
     * @return mixed
     */
    public function grab($id)
    {
        $info = $this->pick($id);
        return array_merge($info, ['id'=>$id]);
    }
}