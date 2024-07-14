<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;


Route::get("/", [TodosController::class, "index"]) -> name("todos");

Route::post("/", [TodosController::class, "store"]) -> name("todos");

Route::get("/{id}", [TodosController::class, "show"]) -> name("todos-show");


Route::delete("/{id}", [TodosController::class, "destroy"]) -> name("todos-update");

Route::patch("/{id}", [TodosController::class, "update"]) -> name("todos-destroy");


Route::resource("/list/categories", CategoriesController::class);
