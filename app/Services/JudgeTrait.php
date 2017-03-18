<?php
namespace app\Services;
trait JudgeTrait
{
    private $grabUrl = '';

    /* the rule for grab problem information */
    private $rules = [];

    private $grabMethod = "";

    /**
     * Grab problem infomation
     *
     * @param $id
     * @return mixed
     */
    public function pick($id)
    {
        $url = sprintf($this->grabUrl, $id);
        $content = [];

        if ($this->grabMethod == 'regular')
        {
            $page = file_get_contents($url);

            foreach ($this->rules as $key => $value)
            {
                preg_match($value, $page, $match);
                $content[$key] = $match[1];
            }
        }
        else if ($this->grabMethod == 'query_list')
            $content = \QL\QueryList::Query($url,$this->rules)->data;

        return array_merge($content, ['id'=>$id]);
    }
}