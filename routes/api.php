<?php

use Illuminate\Http\Request;
use App\Stack;
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

Route::get('/array', function(){
	return response()
            ->json(['name' => 'Abigail', 'state' => 'CA'])
            ->withCallback($request->input('callback'));
});

Route::get('stacks', function() {
    $stacks = Stack::all();    
    return response()->json($stacks);
});

Route::get('s3', function() {
    $s3 = AWS::createClient('s3');
    $s3->putObject(array());
    return 'success';
});
