<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    public function projets(){
      return $this->hasMany('App\Projets', 'categories_id');
    }


}
