<?php

use Illuminate\Support\Facades\Route;
use GIS\StaffPages\Http\Controllers\Admin\DepartmentController;
use GIS\StaffPages\Http\Controllers\Admin\EmployeeController;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix(config("staff-pages.departmentPrefix"))
            ->as("departments.")
            ->group(function () {
                $controllerClass = config("staff-pages.customAdminDepartmentController") ?? DepartmentController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
                Route::get("/{department}", [$controllerClass, "show"])->name("show");
            });

        Route::prefix(config("staff-pages.employeePrefix"))
            ->as("employees.")
            ->group(function () {
                $controllerClass = config("staff-pages.customAdminEmployeeController") ?? EmployeeController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
                Route::get("/{employee}", [$controllerClass, "show"])->name("show");
            });
    });
