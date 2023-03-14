<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function onefirst(Request $request)
    {
        // 查询单条数据返回
        $data = Faq::find(1);
        return $data;
    }
    // ORM 一对一查询 预加载 user 表信息 
    public function hasonefirst(Request $request)
    {
        $data = Faq::with('user')->where("id", 1)->first();
        return $data;
    }
    // ORM 一对多  根据用户查询自己发布的问题
    public function faqhasmany()
    {
        return User::with("FaqHasMany")->where("id", 139276)->first();
    }
    // ORM 一对多 针对多问题 添加条件
    public function faqhasmanywhere()
    {
        $data = User::with(["FaqHasManyWhere" => function ($query) {
            // 比如设置 faq 表中 type = 1
            $query->where('type', '=', 2);
            $query->Orderby('id', 'desc');
        }])->where("id", 139276)->first();
        return $data;
    }
    // ORM 一对一   hasOne belongsTo 没什么区别 反向取值 
    // hasOne user 取 faq
    // belongsTo faq 取 user
    // where uid = faq表中uid
    public function userbelongto()
    {
        return Faq::with('userbelongto')->where("uid", 3)->first();
    }
    public function userbelongtomany()
    {

        // DB::connection()->enableQueryLog();     // 开启查询日志
        $data = User::with('areasbelongtomany')->where("id", 139276)->get(["*", 'id as uid']);
        // $logs = DB::getQueryLog();   // 获取查询日志

        // dd($logs);               // 即可查看执行的sql，传入的参数等等
        dd($data->Toarray());
    }
}
