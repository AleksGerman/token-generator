<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:30
 */
namespace Coccoc\Components\Validator;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var string
     */
    protected $lastError = '';

    /**
     * @var array
     */
    protected $requiredFields = [];

    /**
     * @param string $error
     */
    public function setError(string $error)
    {
        $this->lastError = $error;
    }

    /**
     * @return string
     */
    public function getLastError() : string
    {
        return $this->lastError;
    }

    public function isOnlyRequiredFieldsPresents(array $data): bool
    {
        if ($nonExistsFields = array_diff_key($this->requiredFields, $data)) {
            $this->setError('Request doesn\'t contain required fields: ' . implode(', ', array_keys($nonExistsFields)));
            return false;
        }

        if ($extraFields = array_diff_key($data, $this->requiredFields)) {
            $this->setError('Request contains extra fields: ' . implode(', ', array_keys($extraFields)));
            return false;
        }

        return true;
    }

}