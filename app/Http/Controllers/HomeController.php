<?php

namespace App\Http\Controllers;

use App\Projets;
use App\Categories;
use App\Images;
use App\Photos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(){

      $projets = Projets::getActus();

      return view('pages/welcome', [
        'projets' => $projets
      ]);
    }

    public function admin(){
      $projets = Projets::all();
      $categories = Categories::all();
      $photos = Photos::all();
      $images = Images::all();


      return view('pages/admin', [
        "projets" => $projets,
        "categories" => $categories,
        "photos" => $photos,
        "images" => $images,

      ]);
    }
}
