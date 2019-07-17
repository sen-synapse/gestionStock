<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BordereauFournisseur;
use App\Models\Article;
use App\Models\LigneArticleRecus;
use App\User;
use Session;

class ArticleRecusController extends Controller
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
        $articlerecus = LigneArticleRecus::all();
        $brd = BordereauFournisseur::all();
        $articles  = Article::all();
        $users = User::all();

        return view('admin.articlerecus.index')->with('articlerecus', $articlerecus)->with('brd', $brd)->with('users', $users)->with('articles', $articles);
    }


    public function recherche(Request $request)
    {
        $q = $request->recherche;

        $articles = LigneArticleRecus::where('article', 'LIKE' ,'%'.$q.'%')->get();

        $brd = BordereauFournisseur::all();
        $articles  = Article::all();
        $users = User::all();

        return view('admin.articlerecus.index')
              ->with('articlerecus', $articlerecus)
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

    }

    public function ajouter($id)
    {
        //
        $brd = BordereauFournisseur::find($id);

        $articles = Article::all();

        if($articles->count() == 0)
        {
          Session::flash('info', 'Veuillez ajouter d\'abord des articles !');
          return redirect()->back();
        }
        
        return view('admin.articlerecus.create')->with('brd', $brd)->with('articles', $articles);
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
        $artrecus = LigneArticleRecus::all();

        foreach($artrecus as $n)
        {
          if($n->idbrdfourniss == $request->idbrd && $n->idarticle == $request->idarticle)
          {
            Session::flash('info', 'Cet article est deja ajouté. Veuillez choisir un autre !');
            return redirect()->back();
          }
        }

        $this->validate($request, [
          'qte' => 'required|integer',
          'couleur' => 'required'
        ]);

        $atrecu = new LigneArticleRecus;
        $atrecu->idbrdfourniss = $request->idbrd;
        $atrecu->idarticle = $request->idarticle;
        $atrecu->iduser = $request->iduser;
        $atrecu->qte = $request->qte;
        $atrecu->couleur = $request->couleur;

        $atrecu->save();

        Session::flash('success', 'Article Reçu ajouté avec succè !');

        return redirect()->route('admin.articlerecus.index');

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
        $articlerecus = LigneArticleRecus::find($id);

        $articles  = Article::all();

        return view('admin.articlerecus.edit')->with('articlerecus', $articlerecus)->with('articles', $articles);
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
          'qte' => 'required|integer',
          'couleur' => 'required'
        ]);

        $atrecu = LigneArticleRecus::find($id);
        $atrecu->idarticle = $request->idarticle;
        $atrecu->qte = $request->qte;
        $atrecu->couleur = $request->couleur;

        $atrecu->save();

        Session::flash('success', 'Article Reçu modifié avec succè !');

        return redirect()->route('admin.articlerecus.index');
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
        $atr = LigneArticleRecus::find($id);
        $atr->delete();

        Session::flash('success', 'Artcie reçus supprimé avec succè !');

        return redirect()->back();
    }
}
