<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Asignatura extends \App\Entity\Asignatura implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as __load;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'clases' => [parent::class, 'clases', null],
        "\0".parent::class."\0".'descripcion' => [parent::class, 'descripcion', null],
        "\0".parent::class."\0".'id' => [parent::class, 'id', null],
        "\0".parent::class."\0".'img' => [parent::class, 'img', null],
        "\0".parent::class."\0".'nombre' => [parent::class, 'nombre', null],
        'clases' => [parent::class, 'clases', null],
        'descripcion' => [parent::class, 'descripcion', null],
        'id' => [parent::class, 'id', null],
        'img' => [parent::class, 'img', null],
        'nombre' => [parent::class, 'nombre', null],
    ];

    public function __isInitialized(): bool
    {
        return isset($this->lazyObjectState) && $this->isLazyObjectInitialized();
    }

    public function __serialize(): array
    {
        $properties = (array) $this;
        unset($properties["\0" . self::class . "\0lazyObjectState"]);

        return $properties;
    }
}
