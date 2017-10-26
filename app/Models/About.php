<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class About extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'date', 'preview', 'id', 'description'];

//    public function category()
//    {
//        return $this->belongsTo('App\Models\Category');
//    }

    public function getProjectCategory()
    {

    }
}
