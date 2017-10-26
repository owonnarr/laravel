<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Team;
use App\Models\Profile;
use App;
use File;
use DB;

class ProfilesController extends Controller
{
    public static function index($id)
    {
        $team = DB::table('profiles')->where('id', $id)->increment('views', 1);
        $team = Team::find($id);
        $profiles = Profile::find($id);
//        $team = Team::all();
//        $profiles = Profile::all();

        return view('dashboard.show', [
            'team' => $team,
            'profiles' => $profiles,
        ]);
    }
}
