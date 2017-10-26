<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\About;
use App\Models\Team;
use App\Models\Teams_Profile;
use Illuminate\Support\Facades\DB;
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

Route::get('/', "Frontend\DefaultController@index");

Auth::routes();

Route::post('/email','Frontend\DefaultController@email');

Route::get('/dashboard', 'Backend\DashboardController@index');
Route::get('/profiles/{id}', 'Backend\ProfilesController@index');

Route::resource('/dashboard/projects', 'Backend\ProjectsController');
Route::resource('/dashboard/categories', 'Backend\CategoriesController');
Route::resource('/dashboard/abouts', 'Backend\AboutsController');
Route::resource('/dashboard/teams', 'Backend\TeamsController');


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