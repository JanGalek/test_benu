<?php declare(strict_types = 1);

namespace App\Utils;

interface Arrayable
{

    /**
     * @return array<mixed,mixed>
     */
    public function toArray(): array;

}
