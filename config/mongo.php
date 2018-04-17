<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 15:21
 */

return [
    'dsn' => env('MONGO_DSN'),
    'db_name' => env('MONGO_DB_NAME', 'token-generator'),
    'collection_config' => [
        'init' => [
            \Coccoc\Repositories\TokenDB::COLLECTION_NAME => [
                'name' => \Coccoc\Repositories\TokenDB::SOURCE_ARRAY_DOCUMENT_NAME,
                'max' => 0,
                'items' => range(10000, 1000000)
            ],
        ],
    ],
];