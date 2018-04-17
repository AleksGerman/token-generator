<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 23/11/2017
 * Time: 16:31
 */
namespace Coccoc\Callbacks;

use Coccoc\Components\Callback\CallbackInterface;
use Coccoc\Entities\TokenEntity;
use Coccoc\Services\TokenService;
use Coccoc\Repositories\FileInfoDB;
use Coccoc\Components\Exception\TokenGeneratorException;
use Predis\Connection\ConnectionException;

class TokenValidatorCallback implements CallbackInterface
{
    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @var FileInfoDB
     */
    protected $fileInfoDB;

    /**
     * TokenCreatorCallback constructor.
     * @param TokenService $tokenService
     * @param FileInfoDB $fileInfoDB
     */
    public function __construct(
        TokenService $tokenService,
        FileInfoDB $fileInfoDB
    )
    {
        $this->tokenService = $tokenService;
        $this->fileInfoDB = $fileInfoDB;
    }

    /**
     * @param $tokenEntity TokenEntity
     * @return array
     * @throws TokenGeneratorException
     */
    public function handle($tokenEntity): array
    {
        try {
            $fileInfo = $this->fileInfoDB->getFileInfoByToken($tokenEntity);
        } catch (ConnectionException $e) {
            throw TokenGeneratorException::redisError();
        }

        return ['expired' => empty($fileInfo), 'file_info' => (array) $fileInfo];
    }
}