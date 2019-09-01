<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Session;
class FournisseursController extends Controller
{

    public function __construct()
    {
      $this->middleware('utilisateur.niveau', ['except' => ['create', 'store', 'index', 'show', 'edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['fournisseurs'] = Fournisseur::all();
        return view('admin.fournisseurs.index')->with($arr);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fournisseur $fournisseur)
    {

      $this->validate($request, [
        'raisonsocial' => 'required',
        'email' => 'required|email|unique:fournisseurs',
        'telephone' => 'required|integer',
        'adresse' => 'required|string',
        'responsable' => 'required',
        'bureautel' => 'required|integer',
        'code' => 'required|integer',
        'numcomptebank' => 'required|integer',

      ]);
        $fournisseur->raisonsocial = $request->raisonsocial;
        $fournisseur->email = $request->email;
        $fournisseur->telephone = $request->telephone;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->responsable = $request->responsable;
        $fournisseur->bureautel = $request->bureautel;
        $fournisseur->fax = $request->code;
        $fournisseur->numcomptebank = $request->numcomptebank;
        $fournisseur->save();

        Session::flash('success', 'Fournisseur ajouté avec succé !');
        return redirect()->route('admin.fournisseurs.index');
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
        $fournisseur = Fournisseur::find($id);

        return view('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        $arr['fournisseur'] = $fournisseur;
        return view('admin.fournisseurs.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {

        $this->validate($request, [
          'raisonsocial' => 'required',
          'email' => 'required|email',
          'telephone' => 'required|integer',
          'adresse' => 'required|string',
          'responsable' => 'required',
          'bureautel' => 'required',
          'code' => 'required|integer',
          'numcomptebank' => 'required|integer'
        ]);


        $fournisseur->raisonsocial = $request->raisonsocial;
        $fournisseur->email = $request->email;
        $fournisseur->telephone = $request->telephone;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->responsable = $request->responsable;
        $fournisseur->bureautel = $request->bureautel;
        $fournisseur->fax = $request->code;
        $fournisseur->numcomptebank = $request->numcomptebank;
        $fournisseur->save();
        Session::flash('success', 'Fournisseur modifié avec succè !');
        return redirect()->route('admin.fournisseurs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fournisseur::destroy($id);
        Session::flash('success', 'Fournisseur supprimé avec succé !');
        return redirect()->route('admin.fournisseurs.index');
    }
}
