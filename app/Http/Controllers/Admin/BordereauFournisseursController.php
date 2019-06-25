<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fournisseur;
use App\Models\BordereauFournisseur;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BordereauFournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['bordereaufournisseurs'] = BordereauFournisseur::paginate(5);
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
        return view('admin.bordereaufournisseurs.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,BordereauFournisseur $bordereaufournisseurs)
    {
        if($request->fichier->getClientOriginalName()){
            $ext =  $request->fichier->getClientOriginalExtension();
            $file = "bordereau".date('YmdHis').'.'.$ext;
            $request->fichier->storeAs('public/bordereaufournisseurs',$file);
        }
        else
        {
            $file = '';
        }
        $bordereaufournisseurs->idfourniss = $request->fournisseur_id;
        $bordereaufournisseurs->fichier = $file;
        $bordereaufournisseurs->datebrd = $request->date;
        $bordereaufournisseurs->save();
        return redirect()->route('admin.bordereaufournisseurs.index');
    }

}
