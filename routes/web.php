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
Route::get('/Organisationlink',function(){
    return view('admin.Organisation.showOrganisation');
   });

Route::get('/create-organisation',function(){
    return view('admin.Organisation.createOrganisation');
   });


   Route::post('/create-organisation', [App\Http\Controllers\OrganisationController::class, 'storeOrganisation'])->name('create-organisation');
Route::get('/show-organisation', [App\Http\Controllers\OrganisationController::class, 'showOrganisation'])->name('show-organisation');


Route::get('/delete-organisation/{id}', [App\Http\Controllers\OrganisationController::class, 'destroyOrganisation'])->name('delete-organisation');

Route::get('/edit-organisation/{id}', [App\Http\Controllers\OrganisationController::class, 'editOrganisation'])->name('edit-organisation');

Route::post('/update-organisation/{id}', [App\Http\Controllers\OrganisationController::class, 'updateOrganisation'])->name('update-organisation');




?>