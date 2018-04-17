<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:56
 */
namespace Coccoc\Hydrators;

use Coccoc\Components\Hydrator\HydratorInterface;
use Coccoc\Entities\TokenEntity;

class TokenHydrator implements HydratorInterface
{

    public function hydrate(array $data): TokenEntity
    {
        $tokenEntity = new TokenEntity();
        $tokenEntity->setToken($data['token']);

        return $tokenEntity;
    }
}

