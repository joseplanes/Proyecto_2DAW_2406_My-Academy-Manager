<?php

namespace ContainerBTbrmRb;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_P7xx3HService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.P_7xx3H' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.P_7xx3H'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'jwtAuth' => ['privates', 'App\\Services\\JwtAuth', 'getJwtAuthService', true],
            'ur' => ['privates', 'App\\Repository\\UsuarioRepository', 'getUsuarioRepositoryService', true],
        ], [
            'entityManager' => '?',
            'jwtAuth' => 'App\\Services\\JwtAuth',
            'ur' => 'App\\Repository\\UsuarioRepository',
        ]);
    }
}
