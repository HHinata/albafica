<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        $menuList = Menu::get()->toArray();

        $menuJson = [];

        foreach ($menuList as $menu)
        {
            $class = $menu['class'];
            if (isset($menuJson[$class]) == false)
                $menuJson[$class] = [];

            $menuJson[$class][] = $menu;
        }

        return $menuJson;
    }

    public function info()
    {
        $info = Auth::user()->toArray();
        $info['avatar'] = env('USER_AVATAR');
        $info['desc'] = env('USER_DESC');

        $meta = Usermeta::where('user_id', $info['id'])->get()->toArray();
        $meta = array_column($meta, 'meta_value', 'meta_key');
        $info = array_merge($info, $meta);

        return $info;
    }

    public function token()
    {
        $disk = QiniuStorage::disk('qiniu');
        $key = time();
        $token = $disk->uploadToken($key);
        return ['key'=>\Qiniu\base64_urlSafeEncode($key), 'uptoken'=>$token, 'domain'=>env('QINIU_DOMAIN')];
    }
}
