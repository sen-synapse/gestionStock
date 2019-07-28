<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fournisseur;
use App\Models\BordereauFournisseur;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;


class BordereauFournisseursController extends Controller
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
        $arr['bordereaufournisseurs'] = BordereauFournisseur::paginate(5);
        $arr['fournisseurs'] = Fournisseur::all();
        return view('admin.bordereaufournisseurs.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['fournisseurs'] = Fournisseur::all();

        if($arr['fournisseurs']->count() == 0)
        {
          Session::flash('info', 'Vous devez ajouté au moins un fournisseur d\'abord !');
          return redirect()->back();
        }
        return view('admin.bordereaufournisseurs.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BordereauFournisseur $bordereaufournisseurs)
    {
      
      $fourniss = Fournisseur::where('raisonsocial', 'LIKE', '%'.$request->raisonsocial.'%')->get();
        
      if(!isset($fourniss[0]->id))
      {
        Session::flash('info', 'Ce fournisseur n\'existe pas !');
        return redirect()->back();
      }
     
      $this->validate($request, [
        'raisonsocial' => 'required',
        'fichier' => 'required',
        'date' => 'required'
      ]);

      $fichier = $request->fichier;

      $fichier_new = time().$fichier->getClientOriginalName();

      $fichier->move('uploads\bordereaufournisseurs', $fichier_new);
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


      $bordereaufournisseurs->idfourniss = $fourniss[0]->id;
      $bordereaufournisseurs->fichier = $fichier_new;
      $bordereaufournisseurs->datebrd = $request->date;
      $bordereaufournisseurs->save();
      Session::flash('success', 'Bordereau ajouté avec succé !');
      return redirect()->route('admin.bordereaufournisseurs.index');
    }


    public function show($id)
    {
      $bordereaufournisseur = BordereauFournisseur::find($id);

      $fichier = '/uploads/bordereaufournisseurs/'. $bordereaufournisseur->fichier;
      return redirect($fichier);
    }

    public function destroy($id)
    {
        $bordereaufournisseur = BordereauFournisseur::find($id);

        $bordereaufournisseur->delete();

        Session::flash('success', 'Bordereau supprimé avec succé !');

        return redirect()->route('admin.bordereaufournisseurs.index');
    }

    public function autocomplete(Request $request)
    {

        $query = $request->get('query');
        $data = Fournisseur::where('raisonsocial', 'LIKE', $request->raisonsdocial.'%')
                ->get();
                 
        $output = '<ul class="list-group" style="display:block;position:relative;">';
        foreach($data as $row)
        {
          $output .= '<li class="list-group-item"><a href="#">'. $row->raisonsocial .'</a></li>';
        } 
        $output .= '</ul>';
        return $output;
    }
}
