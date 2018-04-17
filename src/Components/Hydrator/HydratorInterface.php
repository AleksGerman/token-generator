<?php declare(strict_types = 1);

namespace Coccoc\Components\Hydrator;

interface HydratorInterface
{
    /**
     * @param array $data
     */
    public function hydrate(array $data);

}