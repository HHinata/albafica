<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午7:32
 */
namespace App\Services;

use App\Contracts\PlatformContract;

class ZOJService implements PlatformContract
{
    use JudgeTrait;

    function __construct()
    {
        $this->grabUrl = 'http://acm.zju.edu.cn/onlinejudge/showProblem.do?problemCode=%d';

        $this->rules = [
            'title'=>"{bigProblemTitle\">([\\s\\S]*?)</span>}",
            'description'=>"{<BR>([\\s\\S]*?)<H2}",
            'input'=>"{Input</H2>([\\s\\S]*?)<H2}",
            'output'=>"{Output</H2>([\\s\\S]*?)<H2}",
            'sample_input'=>"{Sample Input</H2>([\\s\\S]*?)<H2}",
            'sample_output'=>"{Sample Output</H2>([\\s\\S]*?)<H2}",
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