<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Team;


class Profile extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'teams_id', 'views', 'preview', 'date'];

    public function team()
    {
        return $this->hasOne('App\Models\Team', 'teams_id', 'id');
    }
}
