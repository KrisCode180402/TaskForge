<?php

namespace Config;

use Config\Services;

$routes = Services::routes();

// Home Page
$routes->get('/', 'Home::index');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// Dashboard routes with role-based controllers (protected by auth filter)
$routes->get('admin/dashboard', 'Admin::index', ['filter' => 'auth']);
$routes->get('manager/dashboard', 'Manager::index', ['filter' => 'auth']);
$routes->get('employee/dashboard', 'Employee::index', ['filter' => 'auth']);

// Admin route for editing a user
$routes->get('admin/editUser/(:num)', 'Admin::editUser/$1', ['filter' => 'auth']);
$routes->post('admin/updateUser/(:num)', 'Admin::updateUser/$1');


// Task CRUD Routes (protected by auth filter)
$routes->get('tasks', 'TaskController::index', ['filter' => 'auth']);
$routes->get('tasks/create', 'TaskController::create', ['filter' => 'auth']);
$routes->post('tasks/store', 'TaskController::store', ['filter' => 'auth']);
$routes->get('tasks/edit/(:num)', 'TaskController::edit/$1', ['filter' => 'auth']);
$routes->post('tasks/update/(:num)', 'TaskController::update/$1', ['filter' => 'auth']);
$routes->get('tasks/delete/(:num)', 'TaskController::delete/$1', ['filter' => 'auth']);

//api
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    // This sets up RESTful resource routes for tasks
    $routes->resource('tasks');
});

