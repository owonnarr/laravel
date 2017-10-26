<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'category_id', 'preview', 'client', 'description', 'published'];
	
	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}
	
	public function getProjectCategory()
    {
        
    }
	
}
