<?php

namespace App\Models;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Slugger;

    public $timestamps = false;

    protected $fillable = [
        'slug', 'name', 'description'
    ];

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
