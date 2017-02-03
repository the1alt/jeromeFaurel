<?php

namespace App\Http\Traits;


trait AddImage
{


  public static function checkCategorie($categorie){

    if (intval($categorie) == 1){
      $path = 'seriesAnimation/';
    }
    else if (intval($categorie) == 2){
      $path = 'longsMetrages/';
    }
    else if (intval($categorie) == 3){
      $path = 'pubsBA/';
    }
    else if (intval($categorie) == 4){
      $path = 'courtsMetrages/';
    }
    else{
      $path = 'autres/';
    }

    return $path;

  }


}
