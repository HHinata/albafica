<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午7:25
 */
namespace App\Contracts;
interface PlatformContract
{
    public function infoFormat(Array $array);

    public function grabProblem($id);
}