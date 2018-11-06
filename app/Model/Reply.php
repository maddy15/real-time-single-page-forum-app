<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Reply extends Model
{
    protected $guarded = [];
    protected static function boot(){
        parent::boot();
        static::creating(function($reply){
            $reply->user_id = auth()->user()->id;
        });
    }
    public function user(){
        return $this->belongsTo('App\User');
    }


    public function question(){
        return $this->belongsTo('App\Model\Question');
    }

    public function likes(){
        return $this->hasMany('App\Model\Like');
    }
}
