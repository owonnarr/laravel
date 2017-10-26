<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\About;
use App\Models\Team;
use App\Models\Profile;
use App;
use File;
use Image;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.categories', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.categories.create', [
            'categories' => $categories,
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
            'category' => 'required|max:60',
            'description' => 'required',
            'preview' => 'mimes:jpeg,png|max:15000'
        ]);

        $file = $request->file('preview');
        $path = public_path('img/portfolio/category/');
        $filename = $file->hashName();

        $file->move($path, $filename);

        $img = Image::make($path . $filename)->resize(300, null, function ($constraint){
            $constraint->aspectRatio();
        });
        $img->save($path . 'preview_' . $filename);

        $data['preview'] = $filename;

        Category::create($data);

        return redirect('/dashboard/categories');

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

        $category = Category::find($id);
        $categories = Category::all();

        return view('dashboard.categories.edit', [
            'category' => $category,
            'categories' => $categories,
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
            'category' => 'required|max:60',
            'description' => 'required',
            'preview' => 'mimes:jpeg,png|max:15000'
        ]);

        $file = $request->file('preview');

        $categories = Category::find($id);

        if(!empty($file)){
            $this->validate($request, [
                'preview' => 'required|mimes:jpeg,png|max:15000'
            ]);

            $path = public_path('img/portfolio/category/');
            $filename = $file->hashName();

            $oldfile = $path . $categories->preview;

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


        $categories->update($data);

        return redirect('/dashboard/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $path = public_path('img/portfolio/category/');

        $categories = Category::find($id);

        $file = $path . $categories->preview;

        if(File::isFile($file)){
            File::delete($file);
        }

        $categories->delete();

        return redirect('/dashboard/categories');
    }
}