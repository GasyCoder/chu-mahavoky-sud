<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Partner;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/partners', function () {
    return Partner::where('is_active', true)->orderBy('order')->get();
});
