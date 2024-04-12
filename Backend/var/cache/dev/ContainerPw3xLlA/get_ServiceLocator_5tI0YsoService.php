<?php

namespace ContainerPw3xLlA;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_5tI0YsoService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.5tI0Yso' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.5tI0Yso'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'App\\Controller\\AdminController::crearAsignaturas' => ['privates', '.service_locator.fAOFpw7', 'get_ServiceLocator_FAOFpw7Service', true],
            'App\\Controller\\AdminController::crearAulas' => ['privates', '.service_locator.fAOFpw7', 'get_ServiceLocator_FAOFpw7Service', true],
            'App\\Controller\\AdminController::crearClase' => ['privates', '.service_locator.k96.lq6', 'get_ServiceLocator_K96_Lq6Service', true],
            'App\\Controller\\ListController::listarAsignaturas' => ['privates', '.service_locator.duEuCPr', 'get_ServiceLocator_DuEuCPrService', true],
            'App\\Controller\\ListController::listarAulas' => ['privates', '.service_locator.JcuJoe1', 'get_ServiceLocator_JcuJoe1Service', true],
            'App\\Controller\\ListController::listarClases' => ['privates', '.service_locator.TXyTJ1t', 'get_ServiceLocator_TXyTJ1tService', true],
            'App\\Controller\\ListController::listarDias' => ['privates', '.service_locator.ebwTjN1', 'get_ServiceLocator_EbwTjN1Service', true],
            'App\\Controller\\ListController::listarProfesores' => ['privates', '.service_locator.KYiCKuy', 'get_ServiceLocator_KYiCKuyService', true],
            'App\\Controller\\ListController::misClases' => ['privates', '.service_locator.TXyTJ1t', 'get_ServiceLocator_TXyTJ1tService', true],
            'App\\Controller\\MenuController::listarClaseDetalle' => ['privates', '.service_locator..hcxsvo', 'get_ServiceLocator__HcxsvoService', true],
            'App\\Controller\\MenuController::listarClasesbasic' => ['privates', '.service_locator..hcxsvo', 'get_ServiceLocator__HcxsvoService', true],
            'App\\Controller\\MenuController::listarMenus' => ['privates', '.service_locator.JWdUnm1', 'get_ServiceLocator_JWdUnm1Service', true],
            'App\\Controller\\UserController::crearUsuario' => ['privates', '.service_locator.Gy52x5L', 'get_ServiceLocator_Gy52x5LService', true],
            'App\\Controller\\UserController::editUser' => ['privates', '.service_locator.P_7xx3H', 'get_ServiceLocator_P7xx3HService', true],
            'App\\Controller\\UserController::listarUsuarios' => ['privates', '.service_locator.Lq5NDuP', 'get_ServiceLocator_Lq5NDuPService', true],
            'App\\Controller\\UserController::login' => ['privates', '.service_locator.HZHLc46', 'get_ServiceLocator_HZHLc46Service', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\AdminController:crearAsignaturas' => ['privates', '.service_locator.fAOFpw7', 'get_ServiceLocator_FAOFpw7Service', true],
            'App\\Controller\\AdminController:crearAulas' => ['privates', '.service_locator.fAOFpw7', 'get_ServiceLocator_FAOFpw7Service', true],
            'App\\Controller\\AdminController:crearClase' => ['privates', '.service_locator.k96.lq6', 'get_ServiceLocator_K96_Lq6Service', true],
            'App\\Controller\\ListController:listarAsignaturas' => ['privates', '.service_locator.duEuCPr', 'get_ServiceLocator_DuEuCPrService', true],
            'App\\Controller\\ListController:listarAulas' => ['privates', '.service_locator.JcuJoe1', 'get_ServiceLocator_JcuJoe1Service', true],
            'App\\Controller\\ListController:listarClases' => ['privates', '.service_locator.TXyTJ1t', 'get_ServiceLocator_TXyTJ1tService', true],
            'App\\Controller\\ListController:listarDias' => ['privates', '.service_locator.ebwTjN1', 'get_ServiceLocator_EbwTjN1Service', true],
            'App\\Controller\\ListController:listarProfesores' => ['privates', '.service_locator.KYiCKuy', 'get_ServiceLocator_KYiCKuyService', true],
            'App\\Controller\\ListController:misClases' => ['privates', '.service_locator.TXyTJ1t', 'get_ServiceLocator_TXyTJ1tService', true],
            'App\\Controller\\MenuController:listarClaseDetalle' => ['privates', '.service_locator..hcxsvo', 'get_ServiceLocator__HcxsvoService', true],
            'App\\Controller\\MenuController:listarClasesbasic' => ['privates', '.service_locator..hcxsvo', 'get_ServiceLocator__HcxsvoService', true],
            'App\\Controller\\MenuController:listarMenus' => ['privates', '.service_locator.JWdUnm1', 'get_ServiceLocator_JWdUnm1Service', true],
            'App\\Controller\\UserController:crearUsuario' => ['privates', '.service_locator.Gy52x5L', 'get_ServiceLocator_Gy52x5LService', true],
            'App\\Controller\\UserController:editUser' => ['privates', '.service_locator.P_7xx3H', 'get_ServiceLocator_P7xx3HService', true],
            'App\\Controller\\UserController:listarUsuarios' => ['privates', '.service_locator.Lq5NDuP', 'get_ServiceLocator_Lq5NDuPService', true],
            'App\\Controller\\UserController:login' => ['privates', '.service_locator.HZHLc46', 'get_ServiceLocator_HZHLc46Service', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\AdminController::crearAsignaturas' => '?',
            'App\\Controller\\AdminController::crearAulas' => '?',
            'App\\Controller\\AdminController::crearClase' => '?',
            'App\\Controller\\ListController::listarAsignaturas' => '?',
            'App\\Controller\\ListController::listarAulas' => '?',
            'App\\Controller\\ListController::listarClases' => '?',
            'App\\Controller\\ListController::listarDias' => '?',
            'App\\Controller\\ListController::listarProfesores' => '?',
            'App\\Controller\\ListController::misClases' => '?',
            'App\\Controller\\MenuController::listarClaseDetalle' => '?',
            'App\\Controller\\MenuController::listarClasesbasic' => '?',
            'App\\Controller\\MenuController::listarMenus' => '?',
            'App\\Controller\\UserController::crearUsuario' => '?',
            'App\\Controller\\UserController::editUser' => '?',
            'App\\Controller\\UserController::listarUsuarios' => '?',
            'App\\Controller\\UserController::login' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\AdminController:crearAsignaturas' => '?',
            'App\\Controller\\AdminController:crearAulas' => '?',
            'App\\Controller\\AdminController:crearClase' => '?',
            'App\\Controller\\ListController:listarAsignaturas' => '?',
            'App\\Controller\\ListController:listarAulas' => '?',
            'App\\Controller\\ListController:listarClases' => '?',
            'App\\Controller\\ListController:listarDias' => '?',
            'App\\Controller\\ListController:listarProfesores' => '?',
            'App\\Controller\\ListController:misClases' => '?',
            'App\\Controller\\MenuController:listarClaseDetalle' => '?',
            'App\\Controller\\MenuController:listarClasesbasic' => '?',
            'App\\Controller\\MenuController:listarMenus' => '?',
            'App\\Controller\\UserController:crearUsuario' => '?',
            'App\\Controller\\UserController:editUser' => '?',
            'App\\Controller\\UserController:listarUsuarios' => '?',
            'App\\Controller\\UserController:login' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
