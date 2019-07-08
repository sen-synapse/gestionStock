<?php

  namespace App\Http\Controllers\Admin;

  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  use App\Models\Categorie;
  use Session;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['categories'] = Categorie::all();
        return view('admin.categories.index')->with($arr);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Categorie $categorie)
    {
      $this->validate($request,[
        'codecategorie' => 'required',
        'categorie' => 'required'
        ]);

      $categorie->codeCategorie = $request->codecategorie;
      $categorie->categorie = $request->categorie;
      $categorie->save();

      Session::flash('success', 'Categorie ajouté avec succé !');
      return redirect()->route('admin.categories.index');
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
        $categorie = Categorie::find($id);
        $arr['categorie'] = $categorie;
        return view('admin.categories.edit')->with($arr);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modifier(Request $request, $id)
    {

      $this->validate($request,[
        'codecategorie' => 'required',
        'categorie' => 'required'
        ]);

      $categorie = Categorie::find($id);
      $categorie->codeCategorie = $request->codecategorie;
      $categorie->categorie = $request->categorie;
      $categorie->save();

      Session::flash('success', 'Categorie modifié avec succé !');
      return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        Session::flash('success', 'Categorie supprimé avec succé !');
        return redirect()->route('admin.categories.index');
    }
}
