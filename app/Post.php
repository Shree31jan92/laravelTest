<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table='posts';
    protected $primaryKey ='id';
    protected $fillable=['title','content','created_by'];

    public function createdBy()
	{
	    return $this->belongsTo('App\User', 'created_by','id');
	}
}
