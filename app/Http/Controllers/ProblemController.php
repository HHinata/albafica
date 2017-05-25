<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\Tag;
use Faker\Factory;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProblemController extends Controller
{

    /**
     * 首页题目列表
     *
     * @return mixed
     */
    public function index()
    {
        $query = Problem::where("private", 0)->with('tags');
        return $query->paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    /**
     * 后台题目列表
     *
     * @return mixed
     */
    public function rack()
    {
        return Problem::paginate(20, ['id', 'title', 'solved', 'submited']);
    }

    /**
     * 题目详情
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $user = Auth::user();
        return Problem::withCount(['users'=>
            function($query)use($user){
                $uid = $user?$user->id:0;
                $query->where('user_id', $uid);
        }])->find($request->input('id'));
    }

    /**
     * 提交代码功能
     *
     * @param Request $request
     * @return array
     */
    public function submit(Request $request)
    {
        $pid = $request->input('id');
        $problem = Problem::find($pid);
        if ($problem->private) {
            return response('', 404);
        }

        $solution = new Solution();

        $solution->problem_id = $pid;
        $solution->user_id = Auth::user()->id;

        $solution->lang = $request->input('lang');
        $solution->code = $request->input('code');

        $solution->platform = $problem->platform;
        $solution->sign = $problem->sign;

        if ($solution->save())
        {
            $problem->submited++;
            $problem->save();
        }

        return $solution->id;
    }

    /**
     * 爬取其他OJ的题目信息
     *
     * @param Request $request
     * @return mixed
     */
    public function crawler(Request $request)
    {
        $platform = $request->input('plat');
        $sign = $request->input('sign');

        $problem = app()->make(strtoupper($platform))->grab($sign);
        $problem['platform'] = $platform;
        $problem['sign'] = $sign;
        $problem['time_limit'] = 1000;
        $problem['mem_limit'] = 65535;

        return $problem;
    }

    /**
     * 新增题目
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $problem = new Problem();

        $problem->title = $request->input('title');
        $problem->desc = $request->input('description');
        $problem->input = $request->input('input');
        $problem->output = $request->input('output');

        $problem->sample_input = $request->input('sample_input');
        $problem->sample_output = $request->input('sample_output');

        $problem->time_limit = $request->input('time_limit');
        $problem->mem_limit = $request->input('mem_limit');

        $problem->platform = $request->input('platform');
        if ($problem->platform == 'local')
        {
            $problem->data_input = $request->input('data_input');
            $problem->data_output = $request->input('data_output');
        }
        else    $problem->sign = $request->input('sign');

        if ($problem->save())
        {
            $tags = $request->input('tags');
            foreach ($tags as &$tag)
            {
                if (is_string($tag))
                {
                    $tagObj = new Tag();
                    $tagObj->name = $tag;
                    $tagObj->save();
                    $tag = $tagObj->id;
                }
            }
            $problem->tags()->sync($tags);
        }

        return $problem->id;
    }

    public function update(Request $request)
    {
        $problem = Problem::find($request->input('id'));

        $problem->title = $request->input('title');
        $problem->desc = $request->input('desc');
        $problem->input = $request->input('input');
        $problem->output = $request->input('output');

        $problem->sample_input = $request->input('sample_input');
        $problem->sample_output = $request->input('sample_output');

        $problem->time_limit = $request->input('time_limit');
        $problem->mem_limit = $request->input('mem_limit');
        $problem->points = $request->input('points');

        $problem->platform = $request->input('platform');
        if ($problem->platform == 'local')
        {
            $problem->data_input = $request->input('data_input');
            $problem->data_output = $request->input('data_output');
        }
        else    $problem->sign = $request->input('sign');

        if ($problem->save())
        {
            $tags = $request->input('tags');
            foreach ($tags as &$tag)
            {
                if (is_string($tag))
                {
                    $tagObj = new Tag();
                    $tagObj->name = $tag;
                    $tagObj->save();
                    $tag = $tagObj->id;
                }
            }
            $problem->tags()->sync($tags);
        }

        return $problem->id;
    }

    /**
     * 用于快速搜索题目
     *
     * @param Request $request
     */
    public function seek(Request $request)
    {
        $query = $request->input('query');
        $problemList = Problem::where('title', 'like', "%$query%")->get(['id', 'title'])->toArray();
        array_walk($problemList, function(&$value){
           $value['value'] = $value['title'];
        });
        return $problemList;
    }

    /**
     * 后台题目信息详情
     *
     * @param Request $request
     * @return mixed
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $problem = Problem::with('tags')->find($id)->toArray();
        $problem['tags'] = array_column($problem['tags'], 'id');
        return $problem;
    }

    /**
     * 收藏功能
     *
     * @param Request $request
     * @return mixed
     */
    public function star(Request $request)
    {
        $user = Auth::user();
        if ($user == null)  return response('', 404);
        $uid = $user->id;
        $problem = Problem::has('users')->find($request->input('id'));
        if ($problem)  Problem::find($request->input('id'))->users()->detach($uid);
        else    Problem::find($request->input('id'))->users()->sync([$uid]);
        return $problem->id;
    }

    /**
     * 评论功能
     *
     * @param Request $request
     * @return Comment
     */
    public function comment(Request $request)
    {
        $problem = Problem::find($request->input('id'));
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $problem->comments()->save($comment);
        $comment->user = $comment->user()->first();
        return $comment;
    }

    /**
     * 获得评论信息列表
     *
     * @param Request $request
     * @return mixed
     */
    public function speech(Request $request)
    {
        return Problem::with("comments")->find($request->input('id'));
    }

    /**
     * 导出题目，并生成id
     *
     * @param Request $request
     */
    public function export(Request $request)
    {
        $problemSet = $request->input('problemSet');
        $problemRes = Problem::whereIn('id', array_column($problemSet, 'id'))->get()->toArray();
        foreach ($problemRes as &$problem) {
            unset($problem['id']);
        }

        $faker = Factory::create();
        $faker->addProvider(new Uuid($faker));
        $id = $faker->uuid;
        Storage::put($id, json_encode($problemRes));
        return $id;
    }

    /**
     * 生成下载信息
     *
     * @param Request $request
     */
    public function download(Request $request)
    {
        $uuid = $request->input('uuid');

        return response()->download(
            realpath(base_path('storage/app')).'/'. $uuid,
            $uuid.'.dat'
        );
    }

    /**
     * 导入题目信息
     *
     * @param Request $request
     */
    public function import(Request $request)
    {
        $file = $request->data->store('json');
        $content = Storage::get($file);
        $data = json_decode($content, true);
        foreach ($data as $item)
        {
            $problem = new Problem($item);
            $problem->save();
        }
        return $file;
    }
}
