<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
	protected $fillable = [
		'tagname',
	];
	
	public function post()
	{
		return $this->morphedByMany('App\Post', 'taggable');
	}
}
