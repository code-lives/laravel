<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = "faq";
    /**
     * 表结构
     * id 自增
     * uid 用户uid
     * content 内容
     * type 问题类型  1文字 2图文
     */
    public function user()
    {
        // 关联模型 user表中id  问题表中的用户 uid
        return $this->hasOne(User::class, "id", "uid");
    }
    /**
     *  反向查询User表的数据
     *  withDefault  属性 当 user 表中没有数据的时候 返回哪些数据 可空 可自定义
     */
    public function userbelongto()
    {
        return $this->belongsTo(User::class, "uid", "id")->withDefault(['nickname' => 'hello word']);
    }
}
