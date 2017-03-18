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

    protected $grabUrl = 'http://poj.org/problem?id=%d';

    protected $rules = [
        'Problem Description'=>"{<p class=\"pst\">Description</p>([\\s\\S]*?)<p class=\"pst\"}",
        'Input'=>"{<p class=\"pst\">Input</p>([\\s\\S]*?)<p class=\"pst\"}",
        'Output'=>"{<p class=\"pst\">Output</p>([\\s\\S]*?)<p class=\"pst\"}",
        'Sample Input'=>"{<p class=\"pst\">Sample Input</p>([\\s\\S]*?)<p class=\"pst\"}",
        'Sample Output'=>"{<p class=\"pst\">Sample Output </p>([\\s\\S]*?)<p class=\"pst\"}",
        'Source'=>"{<p class=\"pst\">Source</p>([\\s\\S]*?)<p class=\"pst\"}",
    ];

    protected $grabMethod = "regular";

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