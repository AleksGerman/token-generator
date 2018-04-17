<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 23/11/2017
 * Time: 18:34
 */

namespace Coccoc\Components\Exception;

class TokenGeneratorException extends \Exception
{
    const REDIS_ERROR = 'Redis connection error';

    const MONGO_ERROR = 'Mongo connection error';

    public static function redisError()
    {
        return new static(self::REDIS_ERROR);
    }
}