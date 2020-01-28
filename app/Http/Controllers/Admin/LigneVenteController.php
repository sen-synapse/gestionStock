<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BordereauLivraison;
use App\Models\Article;
use App\Models\LigneVente;
use App\Models\LigneArticleRecus;
use App\Models\Historique;

use Auth;
use Session;
use DB;

class LigneVenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $articles = Article::all();
        $brdliv = BordereauLivraison::all();
        $ventes = LigneVente::all();

        return view('admin.vente.index')->with('articles', $articles)
                                        ->with('brdliv', $brdliv)
                                        ->with('ventes', $ventes);
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

    public function ajouter($id)
    {
        $brd = BordereauLivraison::find($id);
        $article = Article::all();
        $ars = DB::table('ligne_article_recuses')
        ->select('couleur')
        ->groupBy('couleur')
        ->get();

        if($article->count() == 0)
        {
            Session::flash('info', 'Il n\'y a aucun article ! ');
            return redirect()->back();
        }
        return view('admin.vente.create')->with('brdliv', $brd)
                                        ->with('articles', $article)
                                        ->with('ars', $ars);
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


        $this->validate($request,[
          'articles' => 'required',
          'qte' => 'required|integer'
        ]);

        $article = DB::table('articles')->select('id', 'article')->where('article', '=', $request->articles)->get();

        if($article->count() == 0)
        {
          Session:: flash('info', 'Cet article n\'existe pas ');
          return redirect()->back();
        }

        $ars = LigneArticleRecus::all();

        foreach($ars as $a)
        {
            if($a->idarticle == $request->idarticle && $a->couleur == $request->couleur)
            {
                $ar = $a;
                break;
            }
        }

        if(empty($ar))
        {
            Session::flash('info', 'L\'article choisie et sa couleur n\'existe pas dans les articles reçues !');
            return redirect()->back();
        }

        if($ar->qte >= $request->qte)
        {

            $ar->qte = $ar->qte - $request->qte;
            $ar->save();

            $ventes = LigneVente::all();
            $check = false;

            foreach($ventes as $v)
            {
                if($v->idarticle == $request->idarticle && $v->idbrdliv == $request->idbrdliv)
                {
                    $check = true;
                    $v->qte += $request->qte;
                    $v->save();
                    break;
                }
            }

            if($check == false)
            {
                LigneVente::create([
                    'idarticle' => $article[0]->id,
                    'idbrdliv' => $request->idbrdliv,
                    'qte' => $request->qte
                 ]);
            }

            Historique::create([
                'user' => $request->login,
                'operation' => 'effectué',
                'libelle' => 'vente'
            ]);

            Session::flash('success', 'Vente effectuée avec succée !');

            $articles = Article::all();
            $brdliv = BordereauLivraison::all();
            $ventes = LigneVente::all();

            return view('admin.vente.index')->with('articles', $articles)
                                            ->with('brdliv', $brdliv)
                                            ->with('ventes', $ventes);
        }
        else
        {
            Session::flash('info', 'La quantite demandée est indisponible !');
            return redirect()->back();
        }

    }

    public function fetch(Request $request)
    {

      if($request->get('query'))
      {
        $query = $request->get('query');
        $data = DB::table('articles')
        ->where('article', 'LIKE', '%'.$query.'%')->get();

        return response()->json($data);
      }
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
        $vente = LigneVente::find($id);

        $vente->delete();

        Session::flash('success', 'Ligne supprimée avec succé !');

        return redirect()->back();
    }
}
