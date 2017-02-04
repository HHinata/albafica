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

    private $platform;

    /**
     * Set Judge Platform
     *
     * @param string $platform
     * @return $this
     */
    public function setPlatform($platform='HDU')
    {
        $this->platform = app()->make(strtoupper($platform));

        return $this;
    }

    /**
     * Obtain Problem Infomation
     *
     * @param $platform
     * @param $id
     * @return array
     */
    public function obtainContent($id)
    {
        return $this->platform->obtainContent($id);
    }

    public function submit()
    {

    }
}