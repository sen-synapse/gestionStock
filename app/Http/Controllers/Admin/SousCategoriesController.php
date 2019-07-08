<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\SousCategories;
use Session;

class SousCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $categories = Categorie::all();
      $souscategories = SousCategories::all();

      return view('admin.souscategories.index')->with('categories', $categories)->with('souscategories', $souscategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Categorie::all();
        if($categories->count() == 0)
        {
          Session::flash('info', 'Veuillez ajouter des categories d\'abord !');
          return redirect()->back();
        }
        return view('admin.souscategories.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
          'codesouscat' => 'required',
          'souscategorie' => 'required'
        ]);

        $sc = new SousCategories;
        $sc->codesouscat = $request->codesouscat;
        $sc->souscategorie = $request->souscategorie;
        $sc->idcategorie = $request->idcategorie;
        $sc->save();
        Session::flash('success', 'Sous Catégorie ajouté avec succè !');
        return redirect()->route('admin.souscategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $souscategorie = SousCategories::find($id);
        $categories = Categorie::all();

        return view('admin.souscategories.edit')->with('souscategorie', $souscategorie)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
          'codesouscat' => 'required',
          'souscategorie' => 'required'
        ]);

        $sc = SousCategories::find($id);
        $sc->codesouscat = $request->codesouscat;
        $sc->souscategorie = $request->souscategorie;
        $sc->idcategorie = $request->idcategorie;
        $sc->save();
        Session::flash('success', 'Sous Catégorie modifié avec succè !');
        return redirect()->route('admin.souscategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $souscategorie = SousCategories::find($id);
        $souscategorie->delete();
        Session::flash('success', 'Sous categorie supprimé avec succè !');

        return redirect()->route('admin.souscategories.index');
    }
}
