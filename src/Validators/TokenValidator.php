<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:34
 */
namespace Coccoc\Validators;

use Coccoc\Components\Validator\AbstractValidator;
use Coccoc\Repositories\TokenDB;

class TokenValidator extends AbstractValidator
{
    protected $requiredFields = [
        'token' => 'string',
    ];

    public function isValid(array $data): bool
    {
        if (!$this->isOnlyRequiredFieldsPresents($data)) {
            return false;
        }

        foreach ($this->requiredFields as $field => $type) {
            if (empty($data[$field])) {
                $this->setError('The ' . $field . ' is empty');
                return false;
            }
        }

        if ($data['token'] !== sprintf('%0'. TokenDB::TOKEN_SIZE . 'd', $data['token'])) {
            $this->setError('The token has invalid format');
            return false;
        }

        return true;
    }
}