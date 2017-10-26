<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\About;
use App;
use File;
use Image;

class AboutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();

        return view('dashboard.abouts', [
            'abouts' => $abouts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $abouts = About::all();
        return view('dashboard.abouts.create', [
            'abouts' => $abouts,
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
            'description' => 'required',
            'preview' => 'required|mimes:jpeg,png|max:15000'
        ]);
        $file = false;
        if($request->file('preview')) {
            $file = $request->file('preview');
            $path = public_path('img/portfolio/abouts/');
            $filename = $file->hashName();
            $file->move($path, $filename);
            
            $img = Image::make($path . $filename)->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            });
            $img->save($path . 'preview_' . $filename);
            
            $data['preview'] = $filename;
        }

        About::create($data);
        return redirect('/dashboard/abouts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::find($id);
        $abouts = About::all();

        return view('dashboard.abouts.edit', [
            'about' => $about,
            'abouts' => $abouts,
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
            'description' => 'required',
            'preview' => 'mimes:jpeg,png|max:15000'
        ]);

        $file = $request->file('preview');

        $abouts = About::find($id);

        if(!empty($file)){
            $this->validate($request, [
                'preview' => 'mimes:jpeg,png|max:15000'
            ]);

            $path = public_path('img/portfolio/abouts/');
            $filename = $file->hashName();

            $oldfile = $path . $abouts->preview;

            if(File::isFile($oldfile)){
                File::delete($oldfile);
            }

            $file->move($path, $filename);

            $img = Image::make($path . $filename)->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            });
            $img->save($path . 'preview_' . $filename);

            $data['preview'] = $filename;
        }


        $abouts->update($data);

        return redirect('/dashboard/abouts');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = public_path('img/portfolio/abouts/');

        $abouts = About::find($id);

        $file = $path . $abouts->preview;

        if(File::isFile($file)){
            File::delete($file);
        }

        $abouts->delete();

        return redirect('/dashboard/abouts');
    }
}
