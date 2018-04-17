<?php declare(strict_types = 1);

namespace Coccoc\Components\JsonProcessor;

use Coccoc\Components\Callback\CallbackInterface;
use Coccoc\Components\Validator\ValidatorInterface;
use Coccoc\Components\Validator\AbstractValidator;
use Coccoc\Components\Hydrator\HydratorInterface;
use Coccoc\Components\Exception\TokenGeneratorException;

class JsonProcessor
{
    /**
     * @var AbstractValidator
     */
    private $requestValidator;

    /**
     * @var HydratorInterface
     */
    private $requestHydrator;

    /**
     * @var CallbackInterface
     */
    private $callback;

    /**
     * JsonProcessor constructor.
     * @param ValidatorInterface $requestValidator
     * @param HydratorInterface $requestHydrator
     * @param CallbackInterface $callback
     */
    public function __construct(
        ValidatorInterface $requestValidator,
        HydratorInterface $requestHydrator,
        CallbackInterface $callback
    )
    {
        $this->requestValidator = $requestValidator;
        $this->requestHydrator = $requestHydrator;
        $this->callback = $callback;
    }

    public function process($data): JsonProcessorResult
    {
        $result = [];

        if ($this->requestValidator->isValid($data)) {
            $entity = $this->requestHydrator->hydrate($data);
            try {
                $result = $this->callback->handle($entity);
            } catch (TokenGeneratorException $e) {
                $this->requestValidator->setError($e->getMessage());
            }
        }

        return new JsonProcessorResult(
            $result,
            $this->requestValidator->getLastError()
        );
    }
}