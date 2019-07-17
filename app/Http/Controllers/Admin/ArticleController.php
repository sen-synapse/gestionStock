<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SousCategories;
use App\Models\Article;
use Session;

class ArticleController extends Controller
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
        $souscategories = SousCategories::all();
        $articles = Article::all();

        return view('admin.articles.index')->with('souscategories', $souscategories)->with('articles', $articles);
    }

    public function recherche(Request $request)
    {
        $q = $request->recherche;

        $articles = Article::where('article', 'LIKE' ,'%'.$q.'%')->get();

        $souscategories = SousCategories::all();
        return view('admin.articles.index')->with('souscategories', $souscategories)->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $souscategories = SousCategories::all();

        if($souscategories->count() == 0)
        {
          Session::flash('info', 'Veuillez ajouter d\'abord des sous Catégories !');
          return redirect()->back();
        }
        return view('admin.articles.create')->with('souscategories', $souscategories);
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
          'article' => 'required',
          'codearticle' => 'required',
          'unitearticle' => 'required|integer',
          'dimension' => 'required'
        ]);

        $article = new Article;

        $article->idsoucat = $request->idsoucat;
        $article->codearticle = $request->codearticle;
        $article->article = $request->article;
        $article->unitearticle = $request->unitearticle;
        $article->dimension = $request->dimension;
        $article->save();

        Session::flash('success', 'Article ajouté avec succè !');

        return redirect()->route('admin.articles.index');
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
        $article = Article::find($id);
        $souscategories = SousCategories::all();

        return view('admin.articles.edit')->with('article', $article)->with('souscategories', $souscategories);
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
          'article' => 'required',
          'codearticle' => 'required',
          'unitearticle' => 'required|integer',
          'dimension' => 'required'
        ]);

        $article = Article::find($id);

        $article->idsoucat = $request->idsoucat;
        $article->codearticle = $request->codearticle;
        $article->article = $request->article;
        $article->unitearticle = $request->unitearticle;
        $article->dimension = $request->dimension;
        $article->save();

        Session::flash('success', 'Article modifié avec succè !');

        return redirect()->route('admin.articles.index');
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
        $article = Article::find($id);
        $article->delete();

        Session::flash('success', 'Article supprimé avec succè !');
        return redirect()->back();
    }


}
