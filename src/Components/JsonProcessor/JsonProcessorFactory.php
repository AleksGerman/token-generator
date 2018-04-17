<?php declare(strict_types = 1);

namespace Coccoc\Components\JsonProcessor;

use Coccoc\Components\Callback\CallbackInterface;
use Coccoc\Components\Validator\ValidatorInterface;
use Coccoc\Components\Hydrator\HydratorInterface;

class JsonProcessorFactory
{
    /**
     * @var JsonProcessor
     */
    private $jsonProcessor;

    /**
     * @param ValidatorInterface $validator
     * @param HydratorInterface $hydrator
     * @param CallbackInterface $callback
     * @return JsonProcessor
     */
    public function create(
        ValidatorInterface $validator,
        HydratorInterface $hydrator,
        CallbackInterface $callback
    ) : JsonProcessor
    {
        $this->jsonProcessor = new JsonProcessor($validator, $hydrator, $callback);
        return $this->jsonProcessor;
    }
}