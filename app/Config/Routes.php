<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//home
$routes->get('/', 'Home::index');

//Rutas sobre login y logout
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginProcesar');
$routes->get('/logout', 'AuthController::logout');

//Rutas sobre registro
$routes->get('/registro', 'AuthController::registro');
$routes->post('/registro', 'AuthController::registrar');

//Rutas para usuario Admin
$routes->get('/admin/dashboard', 'Admin\DashboardController::index');
//CRUD marcas
$routes->get('admin/marcas', 'Admin\MarcaController::index');
$routes->get('admin/marcas/crear', 'Admin\MarcaController::crear');
$routes->post('admin/marcas/guardar', 'Admin\MarcaController::guardar');
$routes->get('admin/marcas/editar/(:num)', 'Admin\MarcaController::editar/$1');
$routes->post('admin/marcas/actualizar/(:num)', 'Admin\MarcaController::actualizar/$1');
$routes->get('admin/marcas/eliminar/(:num)', 'Admin\MarcaController::eliminar/$1');
//CRUD productos
$routes->get('/admin/productos', 'Admin\ProductoController::index');
$routes->get('/admin/productos/crear', 'Admin\ProductoController::crear');
$routes->post('/admin/productos/guardar', 'Admin\ProductoController::guardar');
$routes->get('/admin/productos/editar/(:num)', 'Admin\ProductoController::editar/$1');
$routes->post('/admin/productos/actualizar/(:num)', 'Admin\ProductoController::actualizar/$1');
$routes->get('/admin/productos/eliminar/(:num)', 'Admin\ProductoController::eliminar/$1');


//Routes de Catalogo
$routes->get('/catalogo', 'CatalogoController::index');
$routes->get('/catalogo/(:num)', 'CatalogoController::detalle/$1');



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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
