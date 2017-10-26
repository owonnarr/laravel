<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Profile;

class Team extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['name', 'id', 'preview', 'position', 'views', 'description','teams_id'];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public static function index()
    {
       $teams = DB::table('teams')
           ->join('profiles', 'teams_id', '=', 'teams.id')
           ->select('teams.name', 'teams.id', 'teams.position', 'profiles.views', 'teams.description', 'teams.preview')
           ->groupBy('teams.id')
           ->get();
        return $teams;
    }
}
