<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:34
 */
namespace Coccoc\Validators;

use Coccoc\Components\Validator\AbstractValidator;

class FileInfoValidator extends AbstractValidator
{
    protected $requiredFields = [
        'file_path' => 'string',
        'file_size' => 'int',
        'sent_peer_jid' => 'string'
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

            if ($type === 'int' && (string) (int) $data[$field] !== (string) $data[$field]) {
                $this->setError('The ' . $field . ' field have to be integer');
                return false;
            }
        }

        return true;
    }
}