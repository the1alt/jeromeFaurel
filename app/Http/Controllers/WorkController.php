<?php

namespace App\Http\Controllers;

use App\Projets;
use App\Categories;
use App\Images;
use DB;
use Illuminate\Http\Request;
use App\Http\Traits\CleanString;
use App\Http\Traits\AddImage;
use Validator;
use Event;
Use Session;
use Image;

class WorkController extends Controller
{

    use CleanString, AddImage;

    /**
     * Page de navigation
     */
    public function nav(){
      $categories = Categories::all();

      return view ('work/nav', [
        'categories' => $categories,
      ]);
    }

    /**
    * Page index des projets
    */
    public function index(){
      $projets = Projets::all();

      return view('work/index', [
        'projets' => $projets,
      ]);
    }

   /**
   * Page créer un projet
   * Controlleur qui capture la requete
   * pour controller les donnéesentrantes (POST)
   */
   public function create(Request $request){

     $categories = Categories::all();
     $images = Images::all();

     if ($request->isMethod('post')) {

       if ($request->description === "") {
         $request->description = null;
       }

       $validator = Validator::make($request->all(), [
         'categorie' => 'required',
         'titre' => 'required|min:3',
         'video' => 'url',
         'image' => 'required_without:picture|image',
         'picture' => 'required_without:image|image',
       ]);

       if($validator->fails()){
         return redirect('admin/work/create')
            ->withErrors($validator)
            ->withInput();
       }
       else{

         $projet = new Projets();

         $projet->titre = $request->titre;
         $projet->description = $request->description;
         $projet->video = $request->video;
         $projet->categories_id = $request->categorie;

         if(is_null($request->active)){
           $projet->active = 0;
         }else{
           $projet->active = $request->active;
         }

         $filename = '';
         $destinationPath='';
         $subPath='';

         //If a new image is adding
         if ($request->hasFile('image')) {

           $file = $request->file('image');

           $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

           //Met en forme le nom du fichier
           $filename = WorkController::cleanString($filename);

           $extension = explode('.', $filename);
           $extension = ".".end($extension);

           $filenameMin = str_replace($extension, '', $filename).'-min'.$extension ;

           //indique ou stocker le fichier en fonction de la catégorie
           $subPath = WorkController::checkCategorie($request->categorie);

           $destinationPath = public_path().'/uploads/'.$subPath;

           $file->storeAs($subPath, $filename); // enregistre le fichier
           $file->storeAs($subPath, $filenameMin); // enregistre le fichier

           $store = 'https://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filename;
           $storeMin = 'https://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filenameMin;

           $min = Image::make($destinationPath.$filenameMin);
           $min->resize(null, 70, function ($constraint) {
               $constraint->aspectRatio();
           });
           $min->save($destinationPath.$filenameMin, 40);

           $image = new Images();
           $image->name = $filename;
           $image->url = $store;
           $image->categories_id = $request->categorie;
           $image->save();

           $projet->images_id = $image->id;
         }else{
           $projet->images_id = $request->picture;
         }


          Session::flash('flash_message', 'le projet "'.$projet->titre.'" a bien été créé !');

          $projet->save();

          return view('work/create', [
            'categories' => $categories,
            'images' => $images,
          ]);

       }

     }

     return view('work/create', [
       'categories' => $categories,
       'images' => $images,
     ]);
   }

   /**
   * Page supprimer projet
   */
   public function remove($id){

     $projet = Projets::find($id);

     Session::flash('flash_message', 'le projet "'.$projet->titre.'" a bien été supprimé !');

     $projet->delete();
     return redirect()->back();
   }

   /**
   * Page Mettre a jour un projet
   * Controlleur qui capture la requete
   * pour controller les donnéesentrantes (POST)
   */

   public function update(Request $request, $id){

      $categories = Categories::all();
      $images = Images::all();

      $projet = Projets::find($id);
      $test = new Projets();
      if ($request->isMethod('post')) {

        $validator = Validator::make($request->all(), [
          'titre' => 'min:3',
          'video' => 'url',
          'image' => 'image',
        ]);

        if($validator->fails()){
          return redirect('admin/work/update/'.$id)
             ->withErrors($validator)
             ->withInput();
        }
        else{

          if ($request->titre != "") {
            $projet->titre = $request->titre;
          }

          if ($request->description != "") {
            $projet->description = $request->description;
          }

          if ($request->video != "") {
            $projet->video = $request->video;
          }

          if ($request->categorie != "") {
            $projet->categorie_id = $request->categorie;
          }

          if(is_null($request->active)){
            $projet->active = 0;
          }else{
            $projet->active = $request->active;
          }

          if ($request->hasFile('image')) { //Chek if new image is adding
            $filename = '';
            $destinationPath='';
            $subPath = '';

            $file = $request->file('image');
            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

            //Met en forme le nom du fichier
            $filename = WorkController::cleanString($filename);

            $extension = explode('.', $filename);
            $extension = ".".end($extension);

            $filenameMin = str_replace($extension, '', $filename).'-min'.$extension ;

            //indique ou stocker le fichier en fonction de la catégorie
            $subPath = WorkController::checkCategorie($request->categorie);

            $destinationPath = public_path().'/uploads/'.$subPath;

            $file->storeAs($subPath, $filename); // enregistre le fichier
            $file->storeAs($subPath, $filenameMin); // enregistre le fichier

            $store = 'https://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filename;
            $storeMin = 'https://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filenameMin;

            $min = Image::make($destinationPath.$filenameMin);
            $min->resize(null, 70, function ($constraint) {
                $constraint->aspectRatio();
            });
            $min->save($destinationPath.$filenameMin, 40);

            $image = new Images();
            $image->name = $filename;
            $image->url = $store;
            $image->categories_id = $request->categorie;
            $image->save();

            $projet->images_id = $image->id;
          }
          else if ($request->picture != ""){ //check if no new image is adding and if no existant image is select
            $projet->images_id = $request->picture;
          }

          Session::flash('flash_message', 'le projet "'.$projet->titre.'" a bien été modifié !');

          $projet->save();
          return view('work/update', [
            'projet' => $projet,
            'categories' => $categories,
            'images' => $images,

          ]);
        }

      }

      return view('work/update', [
        'projet' => $projet,
        'categories' => $categories,
        'images' => $images,
      ]);
   }

   /**
   * Page afficher les projets d'une catégorie
   * Controlleur qui capture la requete
   * pour controller les donnéesentrantes (POST)
   */
   public function detail($link){

     $categories = Categories::all();

     $categorie = Categories::where('link', $link)->first();

     $projets = Projets::where('categories_id', $categorie->id) // Projets en majuscule
     ->where('active', 1)
     ->orderBy('id', 'desc')
     ->get();

     return view('work/detail', [
       'categories' => $categories,
       'categorie' => $categorie,
       'projets' => $projets
     ]);
   }
}
