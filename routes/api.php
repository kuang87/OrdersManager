<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', function (Request $request){
    $validator = Validator::make($request->all(), [
        'price' => 'required|integer|min:0',
        'id' => 'required|exists:products,id',
    ]);
    if ($validator->fails()){
        return response()->json('error', 400);
    }
    $product = \App\Product::find($request->id);
    $product->price = $request->price;
    $product->save();
    return response()->json($product);
})->name('api.product.update');