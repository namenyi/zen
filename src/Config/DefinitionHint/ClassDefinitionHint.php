<?php
declare(strict_types=1);

namespace WoohooLabs\Zen\Config\DefinitionHint;

use WoohooLabs\Zen\Container\Definition\ClassDefinition;
use WoohooLabs\Zen\Container\Definition\DefinitionInterface;
use WoohooLabs\Zen\Container\Definition\ReferenceDefinition;

class ClassDefinitionHint extends AbstractDefinitionHint
{
    /**
     * @var string
     */
    private $className;

    public static function singleton(string $className)
    {
        return new self($className);
    }

    public static function prototype(string $className)
    {
        $self = new self($className);
        $self->setPrototypeScope();

        return $self;
    }

    public function __construct(string $className)
    {
        parent::__construct();
        $this->className = $className;
        $this->setSingletonScope();
    }

    /**
     * @return DefinitionInterface[]
     */
    public function toDefinitions(string $id): array
    {
        $result = [
            $this->className => new ClassDefinition($this->className, $this->getScope())
        ];

        if ($this->className !== $id) {
            $result[$id] = new ReferenceDefinition($id, $this->className, $this->getScope());
        }

        return $result;
    }
}
