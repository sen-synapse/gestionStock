<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BordereauFournisseur;
use App\Models\Article;
use App\Models\LigneArticleRecus;
use App\User;
use Session;
use DB;
use App\Models\Historique;
use Auth;

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
        /*
        $i = 0;
        $j = 0;
        $k = 0;
        $somme = 0;

        $tab1 = LigneArticleRecus::all();
        $tab2 = $tab1;
        $tab3 = array();
        $result = true;

        while($i < $tab1->count())
        {
          $somme = $tab1[$i]->qte;
          $j = $i + 1;
          while($j < $tab2->count())
          {
            if($tab1[$i]->idarticle == $tab2[$j]->idarticle && $tab1[$i]->couleur == $tab2[$j]->couleur)
            {
              $somme += $tab2[$j]->qte;
            }
            $j++;
          }

          foreach($tab3 as $t)
          {
            if($t->idarticle == $tab1[$i]->idarticle && $t->couleur == $tab1[$i]->couleur)
            {
              $result = false;
              $i++;
            }
          }

          if($result)
          {
            $tab3[$k] = $tab1[$i];
            $tab3[$k]->qte = $somme;
            $k++;
            $i++;
          }

          $result = true;

          $k = sizeof($tab3);
        }
 */
        $articlerecus = DB::table('ligne_article_recuses')
            ->select('idbrdfourniss', 'idarticle', 'iduser' , DB::raw('SUM(qte) as qte'), 'couleur')
            ->groupBy('idarticle', 'couleur')
            ->get();

        $brd = BordereauFournisseur::all();
        $articles  = Article::all();
        $users = User::all();

        return view('admin.articlerecus.index')
              ->with('articlerecus',  $articlerecus)
              ->with('brd', $brd)
              ->with('users', $users)
              ->with('articles', $articles);
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

    public function details($art, $couleur)
    {
      $art = LigneArticleRecus::where('idarticle', '=' , ''.$art.'')->where('couleur', '=' , ''.$couleur.'')->get();

      $brd = BordereauFournisseur::all();
      $articles  = Article::all();
      $users = User::all();

      return view('admin.articlerecus.detartrecus')
            ->with('articlerecus', $art)
            ->with('brd', $brd)
            ->with('users', $users)
            ->with('articles', $articles);

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
        $article = DB::table('articles')->where('article', '=', $request->articles)->get();

        if($article->count() == 0)
        {
          Session:: flash('info', 'Cet article n\'existe pas ');
          return redirect()->back();
        }

        $artrecus = LigneArticleRecus::all();

        foreach($artrecus as $n)
        {
          if($n->idbrdfourniss == $request->idbrd && $n->idarticle == $article[0]->id)
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
        $atrecu->qteabimee = 0;

        $atrecu->save();

        Session::flash('success', 'Article Reçu ajouté avec succè !');

        Historique::create([
          'user' => Auth::user()->id,
          'operation' => 'ajouter',
          'libelle' => 'article reçu'
        ]);

        $brd =  BordereauFournisseur::find($request->idbrd);
        $articlerecus = LigneArticleRecus::all();

        $fourniss = BordereauFournisseur::find($brd->idfourniss);
        $articles = Article::all();
        $users = User::all();

        return view('admin.articlerecus.bordartrecu')
                ->with('brd', $brd)
                ->with('fourniss', $fourniss)
                ->with('articles', $articles)
                ->with('users', $users)
                ->with('articlerecus', $articlerecus);
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

        Historique::create([
          'user' => Auth::user()->id,
          'operation' => 'modifier',
          'libelle' => 'article reçu'
        ]);
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

        Historique::create([
          'user' => Auth::user()->id,
          'operation' => 'supprimer',
          'libelle' => 'article reçu'
        ]);

        Session::flash('success', 'Artcie reçus supprimé avec succè !');

        return redirect()->back();
    }
}
