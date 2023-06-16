<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    //事务操作
    public function transaction()
    {
        $redis = Redis::connection();
        $redis->transaction();
        try {
            $redis->set('user', 1);
            $redis->exec();
            echo "success";
        } catch (\Exception $th) {
            $redis->discard();
            throw $th;
        }
    }
    //队列
    public function redisQueue()
    {
    }
}
