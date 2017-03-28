<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Tag;
use App\Models\Usermeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use zgldh\QiniuStorage\QiniuStorage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function menu()
    {

        if (Auth::user()->hasRole('admin')) $menuList = Menu::get()->toArray();
        else    $menuList = Menu::where('class', 'Base')->get()->toArray();

        $menuJson = [];
        foreach ($menuList as $menu)
        {
            $class = $menu['class'];
            if (isset($menuJson[$class]) == false)
            {
                $menuJson[$class] = [$menu];
            }
            else    $menuJson[$class][] = $menu;
        }
        return $menuJson;
    }

    public function info()
    {
        return Auth::user();
    }

    public function tag()
    {
        return Tag::find(1)->posts;
    }

    public function token()
    {
        $disk = QiniuStorage::disk('qiniu');
        $key = time();
        $token = $disk->uploadToken($key);
        return ['key'=>\Qiniu\base64_urlSafeEncode($key), 'uptoken'=>$token, 'domain'=>env('QINIU_DOMAIN')];
    }

    public function tags()
    {
        $tags = Tag::all()->toArray();
        foreach ($tags as &$tag)
        {
            $tag = ['value'=>$tag['id'], 'label'=>$tag['name']];
        }
        return $tags;
    }
}
