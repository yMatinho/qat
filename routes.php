<?php

use Framework\Singleton\Route\Route;

Route::get()->addGet("/", "SiteController@showHome", 'site.home');

Route::get()->addGet("/product/list", "ProductController@showList", 'product.list');
Route::get()->addGet("/product/create", "ProductController@showCreate", 'product.create');
Route::get()->addGet("/product/edit", "ProductController@showEdit", 'product.edit');
Route::get()->addPost("/product/update", "ProductController@update", 'product.update');
Route::get()->addPost("/product/destroy", "ProductController@destroy", 'product.destroy');
Route::get()->addPost("/product/store", "ProductController@store", 'product.store');