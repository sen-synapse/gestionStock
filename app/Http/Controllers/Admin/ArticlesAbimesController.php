<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB; 
use App\User; 
use App\Models\Article; 
use Session; 
use App\Models\LigneArticleRecus; 
use App\Models\BordereauFournisseur; 
use App\Models\Historique; 
use Auth; 

class ArticlesAbimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $art = LigneArticleRecus::where('qteabimee', '>' ,  0 )->get();

        $brd = BordereauFournisseur::all();
        $articles  = Article::all();
        $users = User::all();

        return view('admin.articlesabimes.index')
                ->with('articlerecus', $art)
                ->with('brd', $brd)
                ->with('users', $users)
                ->with('articles', $articles);
        
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
            'qteabime' => 'required|integer'
        ]);
        
  
        if($request->qteabime > $request->qte)
        {
            Session::flash('info', 'La quantite saisie est superieure a la quantite disponible !');
            return redirect()->back();
        } 

        $atrecu = LigneArticleRecus::find($request->id); 
        
        $atrecu->idbrdfourniss = $request->fourniss;
        $atrecu->idarticle = $request->article;
        $atrecu->iduser = $request->user;
        $atrecu->qte -= $request->qteabime;
        $atrecu->couleur = $request->couleur;
        $atrecu->qteabimee += $request->qteabime;
        $atrecu->save(); 

        Historique::create([
            'user' => Auth::user()->id, 
            'operation' => 'ajouter', 
            'libelle' => 'article abimé'
          ]);  

        Session::flash('success', 'Operation effectuee avec succee !');
        return redirect()->back();
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
        $artrecu = LigneArticleRecus::find($id); 

        $artrecu->qteabimee = 0; 
        $artrecu->save(); 
        Historique::create([
            'user' => Auth::user()->id, 
            'operation' => 'supprimer', 
            'libelle' => 'article abimé'
          ]);  
        return redirect()->back();
    }
}
