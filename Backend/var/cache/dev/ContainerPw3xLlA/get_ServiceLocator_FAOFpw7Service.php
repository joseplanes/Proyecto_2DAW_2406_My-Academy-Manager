<?php

namespace ContainerPw3xLlA;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_FAOFpw7Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.fAOFpw7' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.fAOFpw7'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'jwt_auth' => ['privates', 'App\\Services\\JwtAuth', 'getJwtAuthService', true],
            'serializer' => ['privates', 'debug.serializer', 'getDebug_SerializerService', false],
        ], [
            'entityManager' => '?',
            'jwt_auth' => 'App\\Services\\JwtAuth',
            'serializer' => '?',
        ]);
    }
}
