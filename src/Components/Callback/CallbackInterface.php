<?php declare(strict_types = 1);

namespace Coccoc\Components\Callback;

interface CallbackInterface
{
    public function handle($entity);
}