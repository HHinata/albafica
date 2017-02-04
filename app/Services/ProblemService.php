<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午2:51
 */
namespace App\Services;

use App\Contracts\ProblemContract;

class ProblemService implements ProblemContract
{

    /**
     * @param $platform
     * @param $id
     * @return bool|string
     */
    private function getPage($platform, $id)
    {
        switch ($platform)
        {
            case "1":
                $page = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';
                break;
            case "2":
                $page = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';
                break;
            case "3":
                $page = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';
                break;
            default:
                return false;
        }
        return sprintf($page, $id);
    }

    /**
     * @param $platform
     * @return array
     */
    private function getRules($platform)
    {
        if ($platform === 1)
        {
            return array(
                'title' => ['.panel_title','text'],
                'content' => ['.panel_content','html'],
            );
        }else if($platform === 2)
        {
            return array(
                'title' => ['.panel_title','text'],
                'content' => ['.panel_content','html'],
            );
        }else if ($platform === 3)
        {
            return array(
                'title' => ['.panel_title','text'],
                'content' => ['.panel_content','html'],
            );
        }
    }

    /**
     * @param $platform
     * @param $id
     * @return array
     */
    public function obtainContent($platform, $id)
    {
        if (($page = $this->getPage($platform, $id)) === false) return [];
        //采集规则
        $rules = $this->getRules($platform);
        //采集
        $data = \QL\QueryList::Query($page,$rules)->data;
        return $data;
    }

    public function submit()
    {

    }
}