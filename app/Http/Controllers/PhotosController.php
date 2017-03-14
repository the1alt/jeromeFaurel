<?php

namespace App\Http\Controllers;

use App\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\CleanString;
use Validator;
use Event;
Use Session;

class PhotosController extends Controller
{
  use CleanString;

  public function nav(){

    $photos = DB::table('photos')
    ->where('active', '1')
    ->orderBy('id', 'desc')
    ->get();

    return view('pages/photos', [
      'photos' => $photos,
    ]);
  }

  public function index(){
    $photos = Photos::all();

    return view('photos/index', [
      'photos' => $photos,
    ]);
  }
    /**
   * Page créer une photo
   */
   public function create(Request $request){

     if ($request->isMethod('post')) {

       if ($request->description === "") {
         $request->description = null;
       }

       $validator = Validator::make($request->all(), [
         'titre' => 'required|min:3',
         'video' => 'url',
         'image' => 'required|image',
       ]);

       if($validator->fails()){
         return redirect('admin/photos/create')
            ->withErrors($validator)
            ->withInput();
       }
       else{


         $photo = new Photos();

         $photo->titre = $request->titre;
         $photo->description = $request->description;
         $photo->video = $request->video;

         if(is_null($request->active)){
           $photo->active = 0;
         }else{
           $photo->active = $request->active;
         }

         $filename = '';
         $destinationPath='';

          if ($request->hasFile('image')) {

              $file = $request->file('image');
              $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

              //Met en forme le nom du fichier
              $filename = PhotosController::cleanString($filename);

              $destinationPath = public_path().'/uploads/photos';

              $file->move($destinationPath, $filename); // Déplace le fichier

              $store = 'http://jeromefaurel.the-alt.fr/uploads/photos/'.$filename;
              $photo->image = $store;
            }

          $photo->save();

          Session::flash('flash_message', 'la photo "'.$photo->titre.'" a bien été créée !');

          return view('photos/create');
          // return dump($request->description);

       }

     }

     return view('photos/create');
   }


   /**
   * Page supprimer photo
   */
   public function remove($id){

     $photo = Photos::find($id);

     $path = str_replace("http://jeromefaurel.the-alt.fr", "", $photo->image);

     File::delete(public_path().$path);


     Session::flash('flash_message', 'la photo "'.$photo->titre.'" a bien été supprimée !');

     $photo->delete();
     return redirect()->back();
   }




   public function update(Request $request, $id){

      $photo = Photos::find($id);
      if ($request->isMethod('post')) {

        $validator = Validator::make($request->all(), [
          'titre' => 'min:3',
          'video' => 'url',
         //  'description' => 'required',
          'image' => 'image',
          // 'visible' => '',
        ]);

        if($validator->fails()){
          return redirect('admin/photos/update/'.$id)
             ->withErrors($validator)
             ->withInput();
        }
        else{
          if ($request->titre != "") {
            $photo->titre = $request->titre;
          }
          if ($request->description != "") {
            $photo->description = $request->description;
          }
          if ($request->video != "") {
            $photo->video = $request->video;
          }
          if ($request->categorie != "") {
            $photo->categorie_id = $request->categorie;
          }
          if(is_null($request->active)){
            $photo->active = 0;
          }else{
            $photo->active = $request->active;
          }
          if ($request->image != "") {

            $filename = '';
            $destinationPath='';
            $subPath = '';

            $file = $request->file('image');
            $filename = $file->getClientOriginalName(); // Récupère le nom original du fichier

            //Met en forme le nom du fichier
            $filename = PhotosController::cleanString($filename);

            //indique ou stocker le fichier en fonction de la catégorie
            if (intval($request->categorie) === 1){
              $subPath = 'seriesAnimation/';
            }
            else if (intval($request->categorie) === 2){
              $subPath = 'longsMetrages/';
            }
            else if (intval($request->categorie) === 3){
              $subPath = 'pubsBA/';
            }
            else if (intval($request->categorie) === 4){
              $subPath = 'courtsMetrages/';
            }

            $destinationPath = public_path().'/uploads/'.$subPath;

            $file->move($destinationPath, $filename); // Déplace le fichier

            $store = 'http://jeromefaurel.the-alt.fr/uploads/'.$subPath.$filename;
            $photo->image = $store;
          }

          $photo->save();

          Session::flash('flash_message', 'la photo "'.$photo->titre.'" a bien été modifiée !');

          return view('photos/update', [
            'photo' => $photo
          ]);
        }

      }

      return view('photos/update', [
        'photo' => $photo
      ]);
   }

}
