<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 23/11/2017
 * Time: 16:31
 */
namespace Coccoc\Callbacks;

use Coccoc\Components\Callback\CallbackInterface;
use Coccoc\Entities\FileInfoEntity;
use Coccoc\Services\TokenService;
use Coccoc\Repositories\FileInfoDB;
use Coccoc\Validators\FileInfoValidator;
use Coccoc\Components\Exception\TokenGeneratorException;
use Predis\Connection\ConnectionException;
use Coccoc\Repositories\TokenDB;

class TokenCreatorCallback implements CallbackInterface
{
    const MAX_ATTEMPTS = 100;

    /**
     * @var TokenService
     */
    protected $tokenService;

    /**
     * @var FileInfoDB
     */
    protected $fileInfoDB;

    /**
     * @var FileInfoValidator
     */
    protected $fileInfoValidator;

    /**
     * TokenCreatorCallback constructor.
     * @param TokenService $tokenService
     * @param FileInfoDB $fileInfoDB
     * @param FileInfoValidator $fileInfoValidator
     */
    public function __construct(
        TokenService $tokenService,
        FileInfoDB $fileInfoDB,
        FileInfoValidator $fileInfoValidator
    )
    {
        $this->tokenService = $tokenService;
        $this->fileInfoDB = $fileInfoDB;
        $this->fileInfoValidator = $fileInfoValidator;
    }

    /**
     * @param $fileInfoEntity FileInfoEntity
     * @return array
     * @throws TokenGeneratorException
     */
    public function handle($fileInfoEntity): array
    {
        try {
            $attempts = 0;
            do {
                $tokenEntity = $this->tokenService->generate();
                ++$attempts;
            }
            while (!$this->fileInfoDB->saveFileInfo($fileInfoEntity, $tokenEntity) && $attempts <= self::MAX_ATTEMPTS);

        } catch (ConnectionException $e) {
            throw TokenGeneratorException::redisError();
        }

        return ['token' => sprintf('%0'. TokenDB::TOKEN_SIZE . 'd', $tokenEntity->getToken())];
    }
}