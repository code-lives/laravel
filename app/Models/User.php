<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    /**
     * 用户表结构
     * id 自增
     * nickname  用户名
     * telphone  手机号
     */
    public function FaqHasOne()
    {
        //select  取 Faq 表中的 字段 uid 是必须的写的 因为是关联字段 faq->uid = user->id
        return $this->hasone(Faq::class, "uid", "id")->select('id', 'content', 'uid');
    }
    public function FaqHasMany()
    {
        return $this->hasMany(Faq::class, "uid", "id")->select('id', 'content', 'uid', 'type');
    }
    public function FaqHasManyWhere()
    {
        return $this->hasMany(Faq::class, "uid", "id")->select('id', 'content', 'uid', 'type');
    }
    /**
     *  多对多查询 问题有多个 城市也选择了多个
     *  可以看成 belongsToMany 里面 就是一个 join 两表联查
     */
    public function areasbelongtomany()
    {
        // 1.关联模型 Faq::class  
        // 2.中间表  就是 存放多对多记录表
        // 3.user表 在 中间表的 字段 uid
        // 4.关联模型 在 中间表的关联id=faq_id
        // 6.关联模型的id Faq::class  默认id
        // withPivot 可以取 中间表 其他字段
        return $this->belongsToMany(Faq::class, "areas", "uid", "faq_id", "uid", "id")->withPivot("content");
    }
}
