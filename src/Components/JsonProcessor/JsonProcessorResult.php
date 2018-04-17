<?php declare(strict_types = 1);

namespace Coccoc\Components\JsonProcessor;

class JsonProcessorResult
{

    /**
     * @var
     */
    private $data;

    /**
     * @var array
     */
    private $error;

    /**
     * JsonProcessorResult constructor.
     * @param $data
     * @param string $error
     */
    public function __construct(
        $data,
        string $error
    )
    {
        $this->data = $data;
        $this->error = $error;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->error);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'error' => $this->error
        ];
    }
}