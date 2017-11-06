<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\About;
use App\Models\Team;
use App\Models\Teams_Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['admin']], function() {
    Route::get('/dashboard', 'Backend\DashboardController@index');
    Route::resource('/dashboard/projects', 'Backend\ProjectsController');
    Route::resource('/dashboard/categories', 'Backend\CategoriesController');
    Route::resource('/dashboard/abouts', 'Backend\AboutsController');
    Route::resource('/dashboard/teams', 'Backend\TeamsController');
    
    Route::get('/dashboard/logout', function () {
        Auth::logout();
    });
});

Route::get('/', "Frontend\DefaultController@index");

Auth::routes();

Route::post('/email','Frontend\DefaultController@email');


Route::get('/profiles/{id}', 'Backend\ProfilesController@index');


Route::get('/category/{category}', "Frontend\DefaultController@category");


Route::get('/test', function () {
    $projects = Project::all();
    $categories = Category::all();
    $projectscat = Category::getCountProjectsByCategory();
    return view('test', [
        'projects' => $projects,
        'categories' => $categories,
        'projectscat' => $projectscat
    ]);
});