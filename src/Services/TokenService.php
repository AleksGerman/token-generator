<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 11:50
 */
namespace Coccoc\Services;

use Coccoc\Repositories\TokenDB;
use Coccoc\Entities\TokenEntity;

class TokenService
{
    /**
     * @var \MongoDB\Collection
     */
    private $collection;

    /**
     * @var TokenEntity
     */
    private $tokenEntity;

    /**
     * TokenService constructor.
     * @param TokenDB $tokenDB
     * @param TokenEntity $tokenEntity
     */
    public function __construct(TokenDB $tokenDB, TokenEntity $tokenEntity)
    {
        $this->collection = $tokenDB->getCollection();
        $this->tokenEntity = $tokenEntity;
    }

    /**
     * @return TokenEntity
     */
    public function generate(): TokenEntity
    {
       /* $cursor = $this->collection->aggregate([ ['$unwind' => '$items'], ['$sample' => ['size' => 1]]]);

        foreach ($cursor as $item) {
            $this->tokenEntity->setToken($item->items);
        }*/

        $this->tokenEntity->setToken(random_int(10000, 999999));

        return $this->tokenEntity;
    }
}