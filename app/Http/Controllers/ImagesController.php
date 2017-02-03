<?php

namespace App\Http\Controllers;

use App\Images;
use App\Projets;
use App\Categories;
use File;
use App\Http\Traits\CleanString;
use App\Http\Traits\AddImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Event;
Use Session;

class ImagesController extends Controller
{

    use CleanString, AddImage;

    /**
     * Page Index
     */
    public function index(){

      $images = Images::all();

      return view('images/index', [
        "images" => $images,
      ]);
    }

    /**
    * Page supprimer projet
    */
    public function remove($id){

      $image = Images::find($id);

      $path = str_replace("http://localhost:8000", "", $image->url);

      File::delete(public_path().$path);

      Session::flash('flash_message', 'l\'image "'.$image->name.'" a bien été supprimée !');

      $image->delete();

      return redirect()->back();
    }

    /**
    * Page créer un projet
    */
    public function create(Request $request){

      $categories = Categories::all();

      if ($request->isMethod('post')) {

        $validator = Validator::make($request->all(), [
          'image' => 'required|image',
        ]);

        if($validator->fails()){
          return redirect('admin/work/create')
             ->withErrors($validator)
             ->withInput();
        }
        else{

          $filename = '';
          $destinationPath='';
          $subPath='';

          //If a new image is adding
          if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

            //Met en forme le nom du fichier
            $filename = ImagesController::cleanString($filename);

            //indique ou stocker le fichier en fonction de la catégorie
            $subPath = ImagesController::checkCategorie($request->categorie);

            $destinationPath = public_path().'/uploads/'.$subPath;

            $file->move($destinationPath, $filename); // Déplace le fichier

            $store = 'http://localhost:8000/uploads/'.$subPath.$filename;

            $image = new Images();
            $image->name = $filename;
            $image->url = $store;
            $image->categories_id = $request->categorie;
            $image->save();

          }

           Session::flash('flash_message', 'l\'image "'.$image->name.'" a bien été créé !');

           return view('images/create', [
             'categories' => $categories,
           ]);
        }
      }
      else{
        return view('images/create', [
          'categories' => $categories,
        ]);
      }
    }
}
