<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//lista todos los registros Salidas
$routes->resource('restAccesosListSalidas', ['controller' => 'RestController::getSalidas']);

//get entradas todos los registros
$routes->resource('restAccesosListEntradas', ['controller' => 'RestController::getEntradas']);

//crear nuevo registro
$routes->resource('restAccesosCreate', ['controller' => 'RestController::create']);

//crear registro desde los torniquetes
$routes->post('restAccesosCreateTorniquete', 'RestController::crearRegistroTorniquete');

$routes->resource('torniquetest', ['controller' => 'RestController::torniquete']);

//mostrar el resultado de un registro
$routes->resource('restAccesosShow', ['controller' => 'RestController::show']);

//eliminar registro por medio de un id
$routes->resource('restAccesosDelete', ['controller' => 'RestController::delete']);

//crear nuevo user sesion
$routes->resource('restCreateUserSesion', ['controller' => 'RestController::createUser']);

//consultar sesion activa
$routes->resource('restQuerySession', ['controller' => 'RestController::SessionUser']);

//total de entradas registradas
$routes->resource('AllEntradas', ['controller' => 'RestController::countAllEntradas']);

//total de salidas registradas
$routes->resource('AllSalidas', ['controller' => 'RestController::countAllSalidas']);

$routes->group('auth', function ($routes) {
    $routes->add('/', 'Auth::index'); // Redirige automáticamente a login cuando accedan a /dashboard/
    $routes->add('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
    $routes->add('forgot_password', 'Auth::forgot_password');
});

$routes->group('dashboard', function ($routes) {
    $routes->add('/', 'Dashboard::index'); // Redirige automáticamente a login cuando accedan a /dashboard/
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
