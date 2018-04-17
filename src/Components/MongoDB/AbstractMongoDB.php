<?php declare(strict_types = 1);

namespace Coccoc\Components\MongoDB;

use MongoDB\Client as Mongo;

class AbstractMongoDB
{
    protected $db;

    public function __construct()
    {
        $this->db = new Mongo(config('mongo.dsn'));
    }
}