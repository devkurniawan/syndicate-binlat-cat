<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', [
    'filter'    => 'Login'
]);
$routes->group("cat", ["filter" => "Login"], function($routes){
    $routes->get('/', 'Cat::index');
    $routes->post('getdatatable', 'Cat::getDatatable');
    $routes->get('mulaites/(:num)', 'Cat::mulaites/$1');
    $routes->get('domulaites/(:num)', 'Cat::domulaites/$1');
    $routes->post('updateujiansiswa', 'Cat::updateujiansiswa');
    $routes->post('updateujiansiswak', 'Cat::updateujiansiswak');
});

$routes->get('logout', 'Auth::logout');
$routes->group("/", ["filter" => "NoLogin"], function($routes){
    $routes->get('auth', 'Auth::index');
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
});