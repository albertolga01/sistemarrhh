<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginController::index');
$routes->post('validarIngreso','LoginController::validarIngreso');
$routes->get('CerrarSesion','LoginController::CerrarSesion');
 
$routes->get('home','HomeController::index');

$routes->get('usuario','UserController::index');
$routes->post('guardarUsuario','UserController::insertUsuario');
$routes->get('delete/(:num)','UserController::deleteUsuario/$1');
$routes->get('edit/(:num)','UserController::editUsuario/$1');
$routes->post('editarUsuario','UserController::editarUsuario');


$routes->get('empleados','EmpleadoController::index');
$routes->get('crearEmpleado','EmpleadoController::insertEmpleado');
$routes->post('guardarEmpleado','EmpleadoController::guardarEmpleado');
$routes->get('editEmpleado/(:num)','EmpleadoController::editEmpleado/$1');
$routes->post('editarEmpleado','EmpleadoController::editarEmpleado');
$routes->get('deleteEmpleado/(:num)/(:num)','EmpleadoController::deleteEmpleado/$1/$2');
$routes->get('altaEmpleado/(:num)','EmpleadoController::altaEmpleado/$1');

$routes->get('expedientesEmpleado/(:num)','EmpleadoController::expedientesEmpleado/$1');

$routes->get('cartaEmpleado/(:num)','EmpleadoController::cartaEmpleado/$1');
$routes->get('checkListEmpleado/(:num)','EmpleadoController::checkListEmpleado/$1');
$routes->get('cartaGuarderia/(:num)','EmpleadoController::cartaGuarderia/$1');
$routes->post('cartaFonacot','EmpleadoController::cartaFonacot');
$routes->get('empleadosBaja','EmpleadoController::ViewBajaindex');



$routes->get('uniformes','UniformeController::index');
$routes->post('guardarUniforme','UniformeController::guardarUniforme');
$routes->post('editarUniforme','UniformeController::editarUniforme');
$routes->get('eliminarUniforme/(:num)/(:num)','UniformeController::eliminarUniforme/$1/$2');

$routes->get('hijos','HijoController::index');
$routes->post('guardarHijo','HijoController::guardarHijo');
$routes->post('editarHijo','HijoController::editarHijo');
$routes->get('eliminarHijo/(:num)/(:num)','HijoController::eliminarHijo/$1/$2');

$routes->get('candidatos','CandidatoController::index');
$routes->post('guardarCandidato','CandidatoController::guardarCandidato');
$routes->post('editarCandidato','CandidatoController::editarCandidato');
$routes->get('eliminarCandidato/(:num)/(:num)','CandidatoController::eliminarCandidato/$1/$2');



$routes->get('actividades','ActividadController::index');


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
