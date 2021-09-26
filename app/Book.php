<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    public function publisher(){
        return $this->belongsTo('App\Publisher', 'publisher_id');
    }

    public function books_author(){
        return $this->hasMany('App\BooksAuthor');
    }

    public function books_category(){
        return $this->hasMany('App\BooksCategory');
    }
}