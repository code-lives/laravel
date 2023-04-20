# 使用技术

redis、mysql、elasticsearch、rabbitmq、swoole、workerman

# 开发流程

### 1.使用 orm 对数据库的各种操作（模型关联）

```php
    //web.php
    Route::get("orm/first", [IndexController::class, "onefirst"]);
    Route::get("orm/hasone", [IndexController::class, "hasonefirst"]);
    Route::get("orm/faqhasmany", [IndexController::class, "faqhasmany"]);
    Route::get("orm/faqhasmanywhere", [IndexController::class, "faqhasmanywhere"]);
    Route::get("orm/userbelongto", [IndexController::class, "userbelongto"]);
    Route::get("orm/userbelongtomany", [IndexController::class, "userbelongtomany"]);
```

### 2.redis 事务

### 3.mysql+redis 事务封装

### 4.elasticsearch 使用的方式

```php
    //web.php
    Route::get("es/info", [ElasticSearch::class, "infos"]);
    Route::get("es/create", [ElasticSearch::class, "esCreate"]);
    Route::get("es/query", [ElasticSearch::class, "esQuery"]);
    Route::get("es/delete", [ElasticSearch::class, "esDelete"]);
```

### 分词

```php
use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->build();

// 创建索引
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

$client->indices()->create($params);

// 添加文档
$params = [
    'index' => 'my_index',
    'id' => '1',
    'body' => [
        'title' => '这是一个测试标题',
        'content' => '这是一个测试内容，包含一些关键词：测试、标题、内容',
    ],
];

$client->index($params);

// 更新文档
$params = [
    'index' => 'my_index',
    'id' => '1',
    'body' => [
        'doc' => [
            'title' => '这是一个更新后的标题',
            'content' => '这是一个更新后的内容，包含一些关键词：更新、标题、内容',
        ],
    ],
];

$client->update($params);

// 删除文档
$params = [
    'index' => 'my_index',
    'id' => '1',
];

$client->delete($params);

// 搜索文档
$params = [
    'index' => 'my_index',
    'body' => [
        'query' => [
            'multi_match' => [
                'query' => '测试标题',
                'fields' => ['title', 'content'],
                'analyzer' => 'ik_max_word',
            ],
        ],
    ],
];

$response = $client->search($params);

```

### 5.rabbitmq

### 6.swoole

```
composer require swooletw/laravel-swoole

```

### 7.workerman
