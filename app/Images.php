<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Images extends Model
{
    protected $table = 'images';

    public $timestamps = false;

    public function projets(){
      return $this->hasMany('App\Projets');
    }

    public static function getNotUses(){
      return DB::table('images')
      ->leftJoin('projets', 'projets.images_id', 'images.id')
      ->whereNull('projets.images_id')
      ->get();
    }
}
