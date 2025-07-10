<?php declare(strict_types = 1);

namespace App\Presentation\Accessory;

use Latte\Extension;

final class LatteExtension extends Extension
{

    /**
     * @return array|callable[]
     */
    public function getFilters(): array
    {
        return [];
    }

    /**
     * @return array|callable[]
     */
    public function getFunctions(): array
    {
        return [];
    }

}
