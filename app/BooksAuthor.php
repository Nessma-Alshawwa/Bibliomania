<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BooksAuthor extends Model
{
    public function author(){
        return $this->belongsTo('App\Author', 'author_id');
    }
}
