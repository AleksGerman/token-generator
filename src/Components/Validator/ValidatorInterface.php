<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 22/11/2017
 * Time: 10:28
 */
namespace Coccoc\Components\Validator;

interface ValidatorInterface
{
    public function isValid(array $data): bool;

    public function isOnlyRequiredFieldsPresents(array $data): bool;
}