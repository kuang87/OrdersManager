<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main.index');
});

Route::get('weather', function () {
    $weather = new \App\YandexWeather('53.243562', '34.363407');
    return view('main.weather',[
        'weather' => $weather->getWeather(),
    ]);
})->name('weather');

Route::resource('orders', 'OrderController')->except([
    'create', 'store', 'destroy'
]);

Route::resource('products', 'ProductController')->except([
    'create', 'store', 'destroy'
]);
