<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
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
        return view('index');
    }

    /**
     * 用户管理页菜单
     *
     * @return array
     */
    public function menu()
    {
        if (Auth::user()->hasRole('admin')) {
            $menuList = Menu::get()->toArray();
        }
        else {
            $menuList = Menu::where('class', 'Base')->get()->toArray();
        }

        $menuJson = [];
        foreach ($menuList as $menu) {
            $class = $menu['class'];
            if (isset($menuJson[$class]) == false) {
                $menuJson[$class] = [$menu];
            }
            else {
                $menuJson[$class][] = $menu;
            }
        }
        return $menuJson;
    }

    /**
     * 获得当前用户信息
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function info()
    {
        return Auth::user();
    }

    /**
     * 七牛文件上传token
     *
     * @return array
     */
    public function token()
    {
        $key = time();
        $disk = QiniuStorage::disk('qiniu');
        $token = $disk->uploadToken($key);

        return [
            'key'   => \Qiniu\base64_urlSafeEncode($key),
            'uptoken'   => $token,
            'domain'    => env('QINIU_DOMAIN')];
    }

    /**
     * 获得标签列表
     *
     * @return array
     */
    public function tags()
    {
        $tags = Tag::all()->toArray();
        foreach ($tags as &$tag) {
            $tag = [
                'value' => $tag['id'],
                'label' => $tag['name']
            ];
        }
        return $tags;
    }

    /**
     * 獲得權限列表
     */
    public function roles(){
        $tags = Role::all()->toArray();
        foreach ($tags as &$tag) {
            $tag = [
                'value' => $tag['id'],
                'label' => $tag['name']
            ];
        }
        return $tags;
    }
}
