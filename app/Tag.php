<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $fillable = ['slug', 'name'];

	public function posts() {
        return $this->belongsToMany('App\Post'); //,'post_tag'); //->withPivot('tag_id','post_id');
    }

}
