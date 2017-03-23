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
    use JudgeTrait;

    function __construct()
    {
        /* the url for grab problem infomation */
        $this->grabUrl = 'http://acm.hdu.edu.cn/showproblem.php?pid=%d';

        /* the rule for grab problem information */
        $this->rules = [
            'title'=>['h1', 'text'],
            'head' => ['.panel_title','text'],
            'content' => ['.panel_content','html'],
        ];

        $this->grabMethod = "query_list";
    }

    /**
     * Problem infomation format for front end
     *
     * @param array $array
     * @return mixed
     */
    public function format(Array $array)
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
    public function grab($id)
    {
        return $this->format($this->pick($id));
    }
}