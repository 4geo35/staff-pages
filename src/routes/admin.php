<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix(config("staff-pages.employeePrefix"))
            ->as("employees.")
            ->group(function () {
                Route::get("/", function () {
                    return "hello staff";
                })->name("index");
            });
    });
