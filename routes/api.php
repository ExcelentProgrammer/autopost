<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::post("/post/create", [HomeController::class, "index"]);
Route::get("/post/create", [HomeController::class, "index"]);


