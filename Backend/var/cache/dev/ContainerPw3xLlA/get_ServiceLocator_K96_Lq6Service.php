<?php

namespace ContainerPw3xLlA;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_K96_Lq6Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.k96.lq6' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.k96.lq6'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'ar' => ['privates', 'App\\Repository\\AsignaturaRepository', 'getAsignaturaRepositoryService', true],
            'aulaRepository' => ['privates', 'App\\Repository\\AulaRepository', 'getAulaRepositoryService', true],
            'cr' => ['privates', 'App\\Repository\\ClaseRepository', 'getClaseRepositoryService', true],
            'ds' => ['privates', 'App\\Repository\\DiasSemanaRepository', 'getDiasSemanaRepositoryService', true],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'jwt_auth' => ['privates', 'App\\Services\\JwtAuth', 'getJwtAuthService', true],
            'pr' => ['privates', 'App\\Repository\\ProfesorRepository', 'getProfesorRepositoryService', true],
            'serializer' => ['privates', 'debug.serializer', 'getDebug_SerializerService', false],
        ], [
            'ar' => 'App\\Repository\\AsignaturaRepository',
            'aulaRepository' => 'App\\Repository\\AulaRepository',
            'cr' => 'App\\Repository\\ClaseRepository',
            'ds' => 'App\\Repository\\DiasSemanaRepository',
            'entityManager' => '?',
            'jwt_auth' => 'App\\Services\\JwtAuth',
            'pr' => 'App\\Repository\\ProfesorRepository',
            'serializer' => '?',
        ]);
    }
}
