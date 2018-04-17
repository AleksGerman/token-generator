<?php declare(strict_types = 1);

namespace Coccoc\Repositories;

use Coccoc\Components\MongoDB\AbstractMongoDB;

class TokenDB extends AbstractMongoDB
{
    const TOKEN_SIZE = 6;

    /**
     * Source token collection name
     */
    const COLLECTION_NAME = 'token';

    /**
     * Source token array document name
     */
    const SOURCE_ARRAY_DOCUMENT_NAME = 'source_array';

    /**
     * @var \MongoDB\Collection
     */
    private $collection;

    /**
     * TokenDB constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->db->selectDatabase(config('mongo.db_name'));
        $this->collection = $this->db->selectCollection(self::COLLECTION_NAME);
    }

    /**
     * @return \MongoDB\Database
     */
    public function getDb(): \MongoDB\Database
    {
        return $this->db;
    }

    /**
     * @return \MongoDB\Collection
     */
    public function getCollection(): \MongoDB\Collection
    {
        return $this->collection;
    }

}