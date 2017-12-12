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

// The basics of routing and how to pass information into a view
Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function(){
    return View::make('hello', array('name'=> 'friend'));
});

Route::get('/hello2', function(){
    return View::make('hello')->with('name', 'Sean');
});

Route::get('/hello/{name}', function($name){
    return View::make('hello')->with('name', $name);
});

Route::get('/hello2/{name?}', function($name = 'world'){
    return View::make('hello')->with('name', $name);
});

Route::get('/data', function () {
    $data = ['name'=> 'jake', 'email'=>'jholvey@vogtpower.com'];
    return view('hello')->with($data);
});

Route::get('/nihao', function () {
    $data = [
            'name'=> 'jake', 
            'email'=>'jholvey@vogtpower.com',
            'password'=>'123'];
    return view('nihao')->withData($data);
});

// v1 for all the blade basics
Route::get('v1/', function () {
    return View::make('todos.index');
});

Route::get('v1/todos', function () {
    return View::make('todos.index');
});

Route::get('v1/todos/{id}', function ($id) {
    return View::make('todos.show')->withId($id);
});

// v2 for all the controllers
Route::get('v2/', 'TodoListController@index');
Route::get('v2/todos', 'TodoListController@index');
Route::get('v2/todos/{id}', 'TodoListController@show');
// This is a important function
Route::resource('todos', 'TodoListController');