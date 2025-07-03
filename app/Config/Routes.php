<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('productcategory', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProductCategoryController::index');
    $routes->post('', 'ProductCategoryController::create');
    $routes->post('edit/(:num)', 'ProductCategoryController::edit/$1');
    $routes->get('delete/(:num)', 'ProductCategoryController::delete/$1');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('FAQ', 'FAQController::index', ['filter' => 'auth']);
$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);

$routes->get('diskon', 'DiskonController::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'diskon/create', 'DiskonController::create', ['filter' => 'auth']);
$routes->post('diskon/update/(:num)', 'DiskonController::update/$1', ['filter' => 'auth']); // ✅ Fix yang error
$routes->match(['get', 'post'], 'diskon/edit/(:num)', 'DiskonController::edit/$1', ['filter' => 'auth']);
$routes->get('diskon/delete/(:num)', 'DiskonController::delete/$1', ['filter' => 'auth']);

$routes->group('pembelian', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'PembelianController::index');
    $routes->get('updateStatus/(:num)', 'PembelianController::updateStatus/$1');
});
