<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Profile;
use App;
use File;
use DB;
use App\Models\Team;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $profiles = Profile::all();

        $teams = Team::index();
        return view('dashboard.teams', [
           
            'teams' => $teams,
//          'profiles' => $profiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();

        return view('dashboard.teams.create', [
            'teams' => $teams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'name' => 'required|max:60',
            'position' => 'required|max:60',
            'description' => 'required',
            'preview' => 'mimes:jpeg,png|max:15000'
        ]);

        $file = $request->file('preview');
        $path = public_path('img/portfolio/teams/');
        $filename = $file->hashName();

        $file->move($path, $filename);

        $data['preview'] = $filename;

        Team::create($data);

        return redirect('/dashboard/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        $teams = Team::all();

        return view('dashboard.teams.edit', [
            'team' => $team,
            'teams' => $teams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|max:60',
            'position' => 'required|max:60',
            'description' => 'required',
            'preview' => 'mimes:jpeg,png|max:15000'
        ]);

        $file = $request->file('preview');

        $teams = Team::find($id);

        if(!empty($file)){
            $this->validate($request, [
                'preview' => 'mimes:jpeg,png|max:15000'
            ]);

            $path = public_path('img/portfolio/teams/');
            $filename = $file->hashName();

            $oldfile = $path . $teams->preview;

            if(File::isFile($oldfile)){
                File::delete($oldfile);
            }

            $file->move($path, $filename);

            $data['preview'] = $filename;
        }


        $teams->update($data);

        return redirect('/dashboard/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = public_path('img/portfolio/teams/');

        $team = Team::find($id);

        $file = $path . $team->preview;

        if(File::isFile($file)){
            File::delete($file);
        }

        $team->delete();

        return redirect('/dashboard/teams');
    }
}
