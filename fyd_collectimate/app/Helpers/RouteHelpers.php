<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class RouteHelpers
{
    public static function detail_controller($mod_code, $controller_path, $route_name, $fk, $pk)
    {
        Route::middleware(["auth", "can:has_access,'$mod_code'"])->controller($controller_path)->group(function () use ($route_name, $fk, $pk) {
            Route::get('/' . $route_name . '/create/{' . $fk . '}', 'create')->name("$route_name.create");
            Route::post('/' . $route_name . '/store', 'store')->name("$route_name.store");
            Route::get('/' . $route_name . '/{' . $pk . '}', 'show')->name("$route_name.show");
            Route::get('/' . $route_name . '/{' . $pk . '}/edit', 'edit')->name("$route_name.edit");
            Route::put('/' . $route_name . '/{' . $pk . '}', 'update')->name("$route_name.update");
            Route::delete('/' . $route_name . '/{' . $pk . '}', 'destroy')->name("$route_name.destroy");
        });
    }
}
