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
use Image;

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

      $path = str_replace("http://jeromefaurel.the-alt.fr", "", $image->url);

      File::delete(public_path().$path);
      // $filename = $image->filename


      // File::delete($image->url);

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

            // $path = public_path().'/uploads/'.$subPath;

            $file = $request->file('image');

            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

            //Met en forme le nom du fichier
            $filename = ImagesController::cleanString($filename);

            $extension = explode('.', $filename);
            $extension = ".".end($extension);



            $filenameMin = str_replace($extension, '', $filename).'-min'.$extension ;

            // indique ou stocker le fichier en fonction de la catégorie
            $subPath = ImagesController::checkCategorie($request->categorie);

            $destinationPath = public_path().'/uploads/'.$subPath;


            $file->storeAs($subPath, $filename); // enregistre le fichier
            $file->storeAs($subPath, $filenameMin); // enregistre le fichier

            $store = 'http://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filename;
            $storeMin = 'http://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filenameMin;


            $min = Image::make($destinationPath.$filenameMin);
            $min->resize(null, 70, function ($constraint) {
                $constraint->aspectRatio();
            });
            $min->save($destinationPath.$filenameMin, 40);


            $image = new Images();
            $image->name = $filename;
            $image->url = $store;
            $image->url_min = $storeMin;
            $image->categories_id = $request->categorie;
            $image->save();

          }

           Session::flash('flash_message', 'l\'image "'.$image->name.'" a bien été créé !');

          //  return dump($min);
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
