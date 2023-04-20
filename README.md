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

### 5.rabbitmq

### 6.swoole

```
composer require swooletw/laravel-swoole

```

### 7.workerman
