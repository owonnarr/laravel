<?php

namespace App\Http\Controllers\Frontend;


use App\Models\About;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Team;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class DefaultController extends Controller
{
    public function index()
    {
        $projects = Project::all()->where('published', 1);
        $categories = Category::all();
        $abouts = About::all();
        $teams = Team::all();


        $categories = DB::table('categories')
            ->join('projects', 'projects.category_id', '=', 'categories.id')
            ->select('categories.category', 'categories.preview', DB::raw('count(projects.id) as proj') )
            ->groupBy('categories.id')
            ->get();
        return view('default.index', [
            'projectlist' => $projects,
            'categories' => $categories,
            'abouts' => $abouts,
            'teams' => $teams,
        ]);
    }
    
    public function category($category)
    {
        $categories = Category::all();
        $projects = Project::all()->where('published', 1);
        $abouts = About::all();
        $teams = Team::all();
        
        $categories = DB::table('categories')
            ->join('projects', 'projects.category_id', '=', 'categories.id')
            ->select('categories.category', 'categories.preview', DB::raw('count(projects.id) as proj') )
            ->groupBy('categories.id')
            ->get();
        return view('default.index',[
        'projectlist' => $projects,
        'categories' => $categories,
        'abouts' => $abouts,
        'teams' => $teams,
    ]);
        
    }
    
    public function email(Request $request)
    {
        $data = $request->all();
        $user = User::find(1);
        Mail::to($user)->send(new ContactMail($data));
    }
}
