<?php

namespace core;

use controller\home\{HomeController,EmployeeController,InventoryController,LetterController};
use controller\login\LoginController;

/** @var Route $route */
$route->set('/', [LoginController::class, 'index'])->name('login.index')->save();
$route->set('/access', [LoginController::class, 'access'])->name('login.access')->save();

$route->set('/home', [HomeController::class, 'index'])->name('home.index')->auth()->save();
$route->set('/logout', [HomeController::class, 'logout'])->name('home.logout')->auth()->save();

$route->set('/employee', [EmployeeController::class, 'index'])->name('employee.index')->auth()->save();
$route->set('/employee/new', [EmployeeController::class, 'add'])->name('employee.add')->auth()->save();
$route->set('/employee/destroy', [EmployeeController::class, 'destroy'])->name('employee.destroy')->auth()->save();
$route->set('/employee/update', [EmployeeController::class, 'update'])->name('employee.update')->auth()->save();
$route->set('/employee/change', [EmployeeController::class, 'change'])->name('employee.change')->auth()->save();
$route->set('/employee/show', [EmployeeController::class, 'show'])->name('employee.show')->auth()->save();
$route->set('/employee/assigned', [EmployeeController::class, 'assigned'])->name('employee.assigned')->auth()->save();
$route->set('/assigned/destroy', [EmployeeController::class, 'assignedDestroy'])->name('employee.assigned.destroy')->auth()->save();
$route->set('/employee/letter', [EmployeeController::class, 'loadLetter'])->name('employee.load.letter')->auth()->save();

$route->set('/inventory', [InventoryController::class, 'index'])->name('inventory.index')->auth()->save();
$route->set('/inventory/new', [InventoryController::class, 'insert'])->name('inventory.new')->auth()->save();
$route->set('/inventory/destroy', [InventoryController::class, 'destroy'])->name('inventory.destroy')->auth()->save();
$route->set('/inventory/show', [InventoryController::class, 'show'])->name('inventory.show')->auth()->save();

$route->set('/letter/entry', [LetterController::class, 'entry'])->name('letter.entry')->auth()->save();
$route->set('/letter', [LetterController::class, 'index'])->name('letter.index')->auth()->save();
$route->set('/letter/load', [LetterController::class, 'loadDischarge'])->name('letter.load')->auth()->save();
$route->set('/letter/discharge', [LetterController::class, 'discharge'])->name('letter.discharge')->auth()->save();