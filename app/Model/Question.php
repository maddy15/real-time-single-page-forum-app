<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // protected $fillable = ['title','body','slug','category_id','user_id'];


    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replies(){
        return $this->hasMany('App\Model\Reply');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function getPathAttribute(){
        return 'http://localhost:8000/api/questions/' . $this->slug;
    }
}
