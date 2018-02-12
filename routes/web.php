
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

# GET           /                   link.index
Route::get('/', 'LinkController@index')->name('link.index');

# GET           /{link}             link.redirect
Route::get('/{murl}', 'LinkController@redirect')->name('link.redirect');

# GET           /{link}/stats       link.stats
Route::get('/{murl}/stats', 'LinkController@stats')->name('link.stats');

# GET           /link               link.index
# GET           /link/create        link.create
# POST          /link/create        link.store
# GET           /link/{id}/edit     link.edit
# PUT|PATCH     /link/{id}          link.update
# DELETE        /link/{id}          link.destroy
# GET           /link/{id}          link.show
Route::resource('link', 'LinkController',[
    'except' => ['index']
]);
