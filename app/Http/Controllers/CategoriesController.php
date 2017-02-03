<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Images;
use Illuminate\Http\Request;
use App\Http\Traits\CleanString;
use Validator;
use Event;
Use Session;

class CategoriesController extends Controller
{

    use CleanString;

    public function index(){

      $categories = Categories::all();
      return view('categories/index', [
        'categories' => $categories,
      ]);

    }

    /**
    * Page créer un projet
    * Controlleur qui capture la requete
    * pour controller les donnéesentrantes (POST)
    */
    public function create(Request $request){

      if ($request->isMethod('post')) {

        $validator = Validator::make($request->all(), [
          'name' => 'required|min:3'
        ]);

        if($validator->fails()){
          return redirect('admin/categories/create')
             ->withErrors($validator)
             ->withInput();
        }
        else{

          $link = $request->name;
          $link = htmlentities($link, ENT_NOQUOTES, "UTF-8");
          $link = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $link);
          $link = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $link); // pour les ligatures e.g. '&oelig;'
          $link = preg_replace('#&[^;]+;#', '', $link); // supprime les autres caractères
          $link = preg_replace('/[\'\ \_]+/', '-', $link); // supprime les autres caractères
          $link = strtolower($link);


          $categorie = new Categories();
          $categorie->name = $request->name;
          $categorie->link = $link;
          if(is_null($request->active)){
            $categorie->active = 0;
          }else{
            $categorie->active = $request->active;
          }


           Session::flash('flash_message', 'la catégorie "'.$categorie->name.'" a bien été créé !');

           $categorie->save();

           return view('categories/create');

        }

      }

      return view('categories/create');
    }

    /**
    * Page supprimer catégorie
    */
    public function remove($id){

      $categorie = Categories::find($id);

      Session::flash('flash_message', 'la catégorie "'.$categorie->name.'" a bien été supprimée !');

      $categorie->delete();
      return redirect()->back();
    }



    /**
     * page mettre a jour la catégorie
     */
    public function update(Request $request, $id){

      $categorie = Categories::find($id);

      if ($request->isMethod('post')) {

        $validator = Validator::make($request->all(), [
          'name' => 'min:3'
        ]);

        if($validator->fails()){
          return redirect('admin/categories/update/'.$id)
             ->withErrors($validator)
             ->withInput();
        }

        else{
          if($request->name != ""){
            $link = $request->name;
            $link = CategoriesController::cleanString($link);

            $categorie->name = $request->name;
            $categorie->link = $link;
          }

          if(is_null($request->active)){
            $categorie->active = 0;
          }else{
            $categorie->active = $request->active;
          }

           Session::flash('flash_message', 'la catégorie "'.$categorie->name.'" a bien été mise à jour !');

           $categorie->save();

           return view('categories/update', [
             'categorie' => $categorie
           ]);

        }

      }

      return view('categories/update', [
        'categorie' => $categorie
      ]);
    }
}
