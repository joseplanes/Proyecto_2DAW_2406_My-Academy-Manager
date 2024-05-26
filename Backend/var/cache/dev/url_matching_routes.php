<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/admin/asignaturas/crear' => [[['_route' => 'app_adminapp_asignaturas_crear', '_controller' => 'App\\Controller\\AdminController::crearAsignaturas'], null, ['POST' => 0], null, false, false, null]],
        '/api/admin/aulas/crear' => [[['_route' => 'app_admincrear_aula', '_controller' => 'App\\Controller\\AdminController::crearAulas'], null, ['POST' => 0], null, false, false, null]],
        '/api/admin/clase/crear' => [[['_route' => 'app_admincrear_clase', '_controller' => 'App\\Controller\\AdminController::crearClase'], null, ['POST' => 0], null, false, false, null]],
        '/api/list/asignaturas' => [[['_route' => 'app_listapp_asignaturas', '_controller' => 'App\\Controller\\ListController::listarAsignaturas'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/usuarios' => [[['_route' => 'app_listapp_users', '_controller' => 'App\\Controller\\ListController::listarUsuarios'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/clases' => [[['_route' => 'app_listapp_claselist', '_controller' => 'App\\Controller\\ListController::listarClases'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/aulas' => [[['_route' => 'app_listapp_aulas', '_controller' => 'App\\Controller\\ListController::listarAulas'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/profesores' => [[['_route' => 'app_listapp_profesores', '_controller' => 'App\\Controller\\ListController::listarProfesores'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/dias' => [[['_route' => 'app_listapp_dias', '_controller' => 'App\\Controller\\ListController::listarDias'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/misclases' => [[['_route' => 'app_listapp_misclases', '_controller' => 'App\\Controller\\ListController::misClases'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/misclaseshoy' => [[['_route' => 'app_listapp_misclaseshoy', '_controller' => 'App\\Controller\\ListController::misClasesHoy'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/asistencia' => [[['_route' => 'app_listasistencia', '_controller' => 'App\\Controller\\ListController::Asistencia'], null, ['POST' => 0], null, false, false, null]],
        '/api/list/misfaltas' => [[['_route' => 'app_listapp_misfaltas', '_controller' => 'App\\Controller\\ListController::misFaltas'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/misnotas' => [[['_route' => 'app_listapp_misnotas', '_controller' => 'App\\Controller\\ListController::misNotas'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/calificaciones' => [[['_route' => 'app_listcalificaciones', '_controller' => 'App\\Controller\\ListController::Calificaciones'], null, ['POST' => 0], null, false, false, null]],
        '/api/list/mismensajes' => [[['_route' => 'app_listapp_mismensajes', '_controller' => 'App\\Controller\\ListController::misMensajes'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/iniciojornada' => [[['_route' => 'app_listapp_iniciojornada', '_controller' => 'App\\Controller\\ListController::InicioJornada'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/mijornadalaboral' => [[['_route' => 'app_listapp_mijornada', '_controller' => 'App\\Controller\\ListController::miJornada'], null, ['GET' => 0], null, false, false, null]],
        '/api/list/finjornada' => [[['_route' => 'app_listapp_finjornada', '_controller' => 'App\\Controller\\ListController::FinJornada'], null, ['GET' => 0], null, false, false, null]],
        '/api/pdf/misnotas' => [[['_route' => 'app_pdfapp_misnotas_pdf', '_controller' => 'App\\Controller\\PDFController::misNotasPdf'], null, ['GET' => 0], null, false, false, null]],
        '/api/usuarios/crear' => [[['_route' => 'app_usercrear_usuario', '_controller' => 'App\\Controller\\UserController::crearUsuario'], null, ['POST' => 0], null, false, false, null]],
        '/api/usuarios/login' => [[['_route' => 'app_userlogin', '_controller' => 'App\\Controller\\UserController::login'], null, ['POST' => 0], null, false, false, null]],
        '/api/usuarios/editar' => [[['_route' => 'app_usereditar_usuario', '_controller' => 'App\\Controller\\UserController::editUser'], null, ['PUT' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/api/list/(?'
                    .'|clase/([^/]++)(*:229)'
                    .'|mismensajes/(?'
                        .'|([^/]++)(*:260)'
                        .'|crear(*:273)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        229 => [[['_route' => 'app_listapp_clase_detalle', '_controller' => 'App\\Controller\\ListController::listarClaseDetalle'], ['id'], ['GET' => 0], null, false, true, null]],
        260 => [[['_route' => 'app_listapp_mismensajesremi', '_controller' => 'App\\Controller\\ListController::misMensajesUnicos'], ['remi'], ['GET' => 0], null, false, true, null]],
        273 => [
            [['_route' => 'app_listcrear_mensaje', '_controller' => 'App\\Controller\\ListController::crearMensaje'], [], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
