<?php

namespace App\Http\Traits;


trait CleanString
{


  public static function cleanString($str){

    $str = htmlentities($str, ENT_NOQUOTES, "UTF-8");
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    $str = preg_replace('/[\'\ \_]+/', '-', $str); // supprime les autres caractères
    $str = strtolower($str);

    return $str;

  }


}
