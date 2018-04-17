<?php declare(strict_types = 1);

namespace Coccoc\Repositories;

use Illuminate\Support\Facades\Redis;
use Coccoc\Entities\FileInfoEntity;
use Coccoc\Entities\TokenEntity;

class FileInfoDB
{
    /**
     * Source token database name
     */
    const REDIS_TTL = 600;

    /**
     * Source token collection name
     */
    const REDIS_KEY_PREFIX = 'file_pushing_token:';

    /**
     * @param FileInfoEntity $fileInfoEntity
     * @param TokenEntity $tokenEntity
     * @return bool
     */
    public function saveFileInfo(FileInfoEntity $fileInfoEntity, TokenEntity $tokenEntity): bool
    {
        $key = self::REDIS_KEY_PREFIX . $tokenEntity->getToken();

        if (!Redis::hlen($key)) {
            Redis::hmset($key, $fileInfoEntity->toArray());
            Redis::expire($key, self::REDIS_TTL);
            return true;
        }

        return false;
    }

    /**
     * @param TokenEntity $tokenEntity
     * @return mixed
     */
    public function getFileInfoByToken(TokenEntity $tokenEntity)
    {
        $key = self::REDIS_KEY_PREFIX . $tokenEntity->getToken();

        return Redis::hgetall($key);
    }

    /**
     * @param TokenEntity $tokenEntity
     * @return mixed
     */
    public function deleteFileInfoByToken(TokenEntity $tokenEntity)
    {
        $key = self::REDIS_KEY_PREFIX . $tokenEntity->getToken();

        return Redis::del($key);
    }
}