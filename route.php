<?php

namespace core;

use controller\home\HomeController;
use controller\login\LoginController;
use controller\home\EmployeeController;

/** @var Route $route */
$route->set('/', [LoginController::class, 'index'])->name('login.index')->save();
$route->set('/access', [LoginController::class, 'access'])->name('login.access')->save();

$route->set('/home', [HomeController::class, 'index'])->name('home.index')->auth()->save();
$route->set('/logout', [HomeController::class, 'logout'])->name('home.logout')->auth()->save();

$route->set('/employee', [EmployeeController::class, 'index'])->name('employee.index')->auth()->save();