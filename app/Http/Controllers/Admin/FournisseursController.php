<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;

class FournisseursController extends Controller
{

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
        $fournisseur->raisonsocial = $request->raisonsocial;
        $fournisseur->email = $request->email;
        $fournisseur->telephone = $request->telephone;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->responsable = $request->responsable;
        $fournisseur->bureautel = $request->bureautel;
        $fournisseur->fax = $request->fax;
        $fournisseur->numcomptebank = $request->numcomptebank;
        $fournisseur->save();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        $arr['fournisseurs'] = $fournisseur;
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
        $fournisseur->raisonsocial = $request->raisonsocial;
        $fournisseur->email = $request->email;
        $fournisseur->telephone = $request->telephone;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->responsable = $request->responsable;
        $fournisseur->bureautel = $request->bureautel;
        $fournisseur->fax = $request->fax;
        $fournisseur->numcomptebank = $request->numcomptebank;
        $fournisseur->save();
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
        return redirect()->route('admin.fournisseurs.index');
    }

}
