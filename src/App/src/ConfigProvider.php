<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 */
class ConfigProvider
{
    /**
     * Collecting all configuration data
     *
     * @return array[]
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Collecting all dependencies in module
     *
     * @return array[]
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [],
        ];
    }
}
