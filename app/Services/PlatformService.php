<?php
/**
 * Created by PhpStorm.
 * User: skyfire
 * Date: 17-2-4
 * Time: 下午2:51
 */
namespace App\Services;

use App\Contracts\PlatformServiceContract;

class PlatformService implements PlatformServiceContract
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
    public function grabProblem($id)
    {
        return $this->platform->grabProblem($id);
    }

    public function submit($id, $lang, $code)
    {
        return $this->platform->submit($id, $lang, $code);
    }
}