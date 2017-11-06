<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Team;
use App\Models\Profile;
use App\Http\Middleware\IfRoleAdmin;
use App\Events\MyCustomEvent;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
//        $name = Auth::user()->name;
//        
//        event(new MyCustomEvent($name));
        
        $team = Team::all();
        $profile = Profile::all();
        
        return view('dashboard.index');
    }
}
