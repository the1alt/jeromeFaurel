<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Projets extends Model
{


    protected $table = 'projets';


    public function categories(){
      return $this->belongsTo('App\Categories');
    }

    public function images(){
      return $this->belongsTo('App\Images');
    }


    /**
     *  @return Courts Metrages et divers
     */
    public static function getActus(){
      return Projets::where('active', 1)
        ->orderBy('updated_at', 'desc')
        ->take(6)
        ->get();

    }

}
