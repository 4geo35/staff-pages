<?php

use Illuminate\Support\Facades\Route;
use GIS\StaffPages\Http\Controllers\Web\EmployeeController;

Route::middleware(["web"])
    ->as("web.")
    ->group(function () {
        Route::prefix(config("staff-pages.employeePrefix"))
            ->as("employees.")
            ->group(function () {
                $controllerClass = config("staff-pages.customWebEmployeeController") ?? EmployeeController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
            });
    });
