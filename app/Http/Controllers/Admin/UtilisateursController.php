<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
class UtilisateursController extends Controller
{
    //

        public function __construct()
        {
          $this->middleware('utilisateur.niveau', ['except' => ['index', 'show']]);
        }
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $arr['utilisateurs'] = User::all();
            return view('admin.utilisateurs.index')->with($arr);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('admin.utilisateurs.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request, User $utilisateur)
        {
          $this->validate($request, [
            'name' => 'required',
            'prenom' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'niveau' => 'required'
          ]);

          $utilisateur->name = $request->name;
          $utilisateur->prenom = $request->prenom;
          $utilisateur->email = $request->email;
          $utilisateur->password = bcrypt($request->password);
          $utilisateur->niveau = $request->niveau;
          $utilisateur->save();
          Session::flash('success', 'Utilisateur ajouté avec succé !');
          return redirect()->route('admin.utilisateurs.index');
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
        public function edit(utilisateur $utilisateur)
        {
            $arr['utilisateurs'] = $utilisateur;
            return view('admin.utilisateurs.edit')->with($arr);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, User $utilisateur)
        {
            $utilisateur->raisonsocial = $request->raisonsocial;
            $utilisateur->email = $request->email;
            $utilisateur->telephone = $request->telephone;
            $utilisateur->adresse = $request->adresse;
            $utilisateur->responsable = $request->responsable;
            $utilisateur->bureautel = $request->bureautel;
            $utilisateur->fax = $request->fax;
            $utilisateur->numcomptebank = $request->numcomptebank;
            $utilisateur->save();
            return redirect()->route('admin.utilisateurs.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            User::destroy($id);
              Session::flash('success', 'Utilisateur supprimé avec succé !');
            return redirect()->route('admin.utilisateurs.index');
        }
}
