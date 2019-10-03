<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Client; 
use Session; 
use App\Models\Historique; 
use Auth; 

class ClientController extends Controller
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
        // 
        $arr['clients'] = Client::all();
        return view('admin.client.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required|string',
            'tel' => 'required|integer',
          ]); 
        
        Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->tel,
        ]); 

        Historique::create([
            'user' => Auth::user()->id, 
            'operation' => 'ajouter', 
            'libelle' => 'Client'
          ]);
    
        Session::flash('success', 'Client ajouté avec succé !');
        return redirect()->route('admin.client.index'); 
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
        $cl = Client::find($id); 
 
        return view('admin.client.edit')->with('cl', $cl);
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
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required|string',
            'tel' => 'required|integer',
          ]); 
        $cl = Client::find($id); 
        $cl->nom = $request->nom;
        $cl->prenom = $request->prenom;
        $cl->adresse = $request->adresse;
        $cl->telephone = $request->tel;
        $cl->save();
        
        Historique::create([
            'user' => Auth::user()->id, 
            'operation' => 'modifier', 
            'libelle' => 'Client'
          ]);

        Session::flash('success', 'Client modifié avec succè !');
        
        return redirect()->route('admin.client.index');
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
        Client::destroy($id); 

        Historique::create([
            'user' => Auth::user()->id, 
            'operation' => 'supprimer', 
            'libelle' => 'Client'
          ]);

        Session::flash('success', 'Client supprimé avec succé !');
        return redirect()->route('admin.client.index');
    } 

}
