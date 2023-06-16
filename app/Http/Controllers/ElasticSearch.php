<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\DB;

class ElasticSearch extends Controller
{
    public $client = null;
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(["http://elasticsearch:9200"])
            ->setBasicAuthentication('elastic', "123456")
            ->build();
    }
    public function infos()
    {
        $response = $this->client->info();
        echo "<pre>";
        print_R($response);
    }
    // 创建分词索引
    public function esCreateIk()
    {
        $params = [
            'index' => 'ik',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'content' => [
                            'type' => 'text',
                            'analyzer' => 'ik_max_word',
                        ],
                    ],
                ],
            ],
        ];

        $ik = $this->client->indices()->create($params);
        dd($ik->asArray());
    }
    //判断索引是否存在
    public function isIndex()
    {
        $index = $this->client->indices()->exists(
            ['index' => 'ik']
        )->asBool();
        dd($index);
    }
    //查看索引的的信息
    public function indexInfo()
    {
        $index = $this->client->indices()->getMapping(
            ['index' => 'ik']
        );
        dd($index->asArray());
    }
    //删除索引及数据
    public function indexDelete()
    {
        $index = $this->client->indices()->delete(
            ['index' => 'ik']
        );
        dd($index->asArray());
    }
    //删除索引下面id=1的数据
    public function esDelete()
    {
        $params = [
            'index' => 'ik',
            'id' => 1,
        ];
        $response = $this->client->delete($params);
        dd($response->asArray());
    }
    // 数据插入
    public function esCreateIkData()
    {
        $array = [
            'index' => 'ik',
            'type' => 'doc',
            'id' => 1,
            'body' => [
                'content' => '测试数据',
            ],
        ];
        $result = $this->client->index($array);
        dd($result);
    }
    // 批量插入数据
    public function eaCreateIkDataBulk()
    {

        set_time_limit(0);
        $data = DB::table('faq')->get();
        // 一条一条插入
        foreach ($data as $key => $value) {
            $array['body'][] = ['index' => ['_index' => 'ik', '_id' => $value->id]];
            $array['body'][] = ['content' => $value->content];
        }
        $result = $this->client->bulk($array);
        dd($result);
    }
    // 查询当前索引下有多少数据
    public function esCountData()
    {
        $params = [
            'index' => 'ik',
        ];
        echo $this->client->count($params);
    }
    /**
     * 查询 ik 下面所有数据
     * 默认返回最多10数据
     */
    public function esIkSearch()
    {
        $query = [
            'index' => 'ik',
            // 'id' => 1, // 查询id 的话就加这个字段
        ];
        $result = $this->client->search($query);
        dd($result->asArray());
    }
    /**
     * 查询 ik 下面数据 加各种条件
     *
     */
    public function esIkSearchWhere()
    {
        $query = [
            'index' => 'ik',
            'body' => [
                'query' => [
                    'match' => [
                        'content' => '被骗了几千块钱，有微信怎么要回来'
                    ]
                ]
            ],
            '_source' => ['content'], //目前只有content 如果字段多了 想要那个返回哪个。可以不设置。默认返回所有数据 
            'size' => 5, //设置一次返回5条数据、可以不设置
            'from' => 2, //从第几条开始 类似于limit 5,2 可以不设置
        ];
        $result = $this->client->search($query);
        dd($result->asArray());
    }
    /**
     * 修改数据
     * 把 ik 下面 id=1 的content 修改
     */
    public function esIkedit()
    {
        $query = [
            'index' => 'ik',
            'id' => 1,
            'body' => [
                'doc' => [
                    'content' => '修改数据'
                ],
            ],
        ];
        $result = $this->client->update($query);
        dd($result);
    }
}
