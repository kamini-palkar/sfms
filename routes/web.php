<?php

use App\Http\Controllers\GstController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::group(['middleware' => ['auth', 'web']], function() {

Route::get('/home',function(){
 return view('admin.common.main');
});

});
?>