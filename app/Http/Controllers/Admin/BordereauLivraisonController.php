<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\BordereauLivraison; 
use App\Models\Client; 
use Session; 

class BordereauLivraisonController extends Controller
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
        $bdl = BordereauLivraison::all();
        $cl = Client::all(); 
        return view('admin.bordereaulivraison.index')->with('bdl', $bdl)->with('cl', $cl); 
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
        if(empty($request->client)) 
        {
            Session::flash('info', 'Veuillez ajouter au moins un client !'); 
            return redirect()->back();
        } 
        
        $this->validate($request, [
            'date' => 'required',
            'fichier' => 'required'
          ]);
    
          $fichier = $request->fichier;
    
          $fichier_new = time().$fichier->getClientOriginalName();
    
          $fichier->move('uploads\bordereaulivraison', $fichier_new);
          /*
          if($request->fichier->getClientOriginalName()){
              $ext =  $request->fichier->getClientOriginalExtension();
              $file = "bordereau".date('YmdHis').'.'.$ext;
              $request->fichier->storeAs('public/bordereaufournisseurs',$file);
          }
          else
          {
              $file = '';
          } */
          
          BordereauLivraison::create([
            'idclient' => $request->client, 
            'datebrd' => $request->date, 
            'fichier' => $fichier_new
          ]); 

          Session::flash('success', 'Bordereau ajouté avec succé !');
          return redirect()->route('admin.bordereaulivraison.index');
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
        $bd = BordereauLivraison::find($id); 
        $bd->delete();  

        Session::flash('success', 'Bordereau supprimé avec succé !'); 

        return redirect()->back();

    }
}
