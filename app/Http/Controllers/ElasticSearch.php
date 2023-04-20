<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\ClientBuilder;

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
    // 创建
    public function esCreate()
    {
        $doc = [
            'index' => 'my_index',
            'type' => 'doc',
            'id' => 2,
            'body' => [
                'title' => "一二三四五六七八九十",
                'content' => "额。数字啊",
            ],
            'form' => 0,
            'size' => 10,
        ];

        $response = $this->client->index($doc);
        dd($response->asArray());
    }
    public function esQuery()
    {
        $params = [
            'index' => 'my_index',
            'body' => [
                'query' => [
                    'match' => [
                        'title' => '一二'
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        dd($response->asArray());
    }
    public function esDelete()
    {
        $params = [
            'index' => 'my_index',
            'id' => 1,
        ];
        $response = $this->client->delete($params);
        dd($response->asArray());
    }

    public function esIkSearch()
    {
        $params = [
            'index' => 'my_index',
            'body' => [
                'settings' => [
                    'analysis' => [
                        'analyzer' => [
                            'ik_max_word' => [
                                'tokenizer' => 'ik_max_word',
                            ],
                        ],
                    ],
                ],
                'mappings' => [
                    'properties' => [
                        'title' => [
                            'type' => 'text',
                            'analyzer' => 'ik_max_word',
                        ],
                        'content' => [
                            'type' => 'text',
                            'analyzer' => 'ik_max_word',
                        ],
                    ],
                ],
            ],
        ];
    }
}
