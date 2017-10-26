<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['category', 'description', 'preview', 'id'];

    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'category_id', 'id');
    }
	
	public static function getCountProjectsByCategory()
	{
		$categories = DB::table('categories')
			->join('projects', 'projects.category_id', '=', 'categories.id')
			->select('categories.category', 'categories.preview', DB::raw('count(projects.id) as proj'))
			->groupBy('categories.id')
			->get();
		
		return $categories;
	}
}
