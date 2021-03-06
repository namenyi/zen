<?php
declare(strict_types=1);

namespace WoohooLabs\Zen\Examples;

use WoohooLabs\Zen\Config\AbstractCompilerConfig;

class CompilerConfig extends AbstractCompilerConfig
{
    public function getContainerNamespace(): string
    {
        return "WoohooLabs\\Zen\\Examples";
    }

    public function getContainerClassName(): string
    {
        return "Container";
    }

    public function useConstructorInjection(): bool
    {
        return true;
    }

    public function usePropertyInjection(): bool
    {
        return true;
    }

    public function getContainerConfigs(): array
    {
        return [
            new ContainerConfig()
        ];
    }
}
