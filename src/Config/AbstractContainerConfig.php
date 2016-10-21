<?php
declare(strict_types=1);

namespace WoohooLabs\Dicone\Config;

use WoohooLabs\Dicone\Config\DefinitionHint\DefinitionHint;
use WoohooLabs\Dicone\Config\EntryPoint\ClassEntryPoint;
use WoohooLabs\Dicone\Config\EntryPoint\EntryPointInterface;
use WoohooLabs\Dicone\Exception\ContainerConfigException;

abstract class AbstractContainerConfig implements ContainerConfigInterface
{
    /**
     * @return array
     */
    abstract protected function getEntryPoints();

    /**
     * @return array
     */
    abstract protected function getDefinitionHints();

    /**
     * @return EntryPointInterface[]
     */
    public function createEntryPoints(): array
    {
        return array_map(
            function ($entryPoint): EntryPointInterface {
                if ($entryPoint instanceof EntryPointInterface) {
                    return $entryPoint;
                }

                if (is_string($entryPoint)) {
                    return new ClassEntryPoint($entryPoint);
                }

                throw new ContainerConfigException("An entry point must be either a string or an EntryPoint object!");
            },
            $this->getEntryPoints()
        );
    }

    /**
     * @return DefinitionHint[]
     */
    public function createDefinitionHints(): array
    {
        return array_map(
            function ($definitionHint): DefinitionHint {
                if ($definitionHint instanceof DefinitionHint) {
                    return $definitionHint;
                }

                if (is_string($definitionHint)) {
                    return new DefinitionHint($definitionHint);
                }

                throw new ContainerConfigException(
                    "A definition hint must be either a string or a DefinitionHint object"
                );
            },
            $this->getDefinitionHints()
        );
    }
}