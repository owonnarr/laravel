<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Team;
use App\Models\Profile;
use App\Http\Middleware\IfRoleAdmin;

class DashboardController extends Controller
{

    public function index()
    {
        $team = Team::all();
        $profile = Profile::all();
        
        return view('dashboard.index');
    }
}
