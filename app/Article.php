<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";
    protected $fillable = [
        'id','title','content','created_at','updated_at'
    ];

    //public static function valid(){
    //   return array(
    //        'content' => 'required'
    //    );
    //}

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function Images(){
        return $this->hasMany('App\Image');
    }
}
