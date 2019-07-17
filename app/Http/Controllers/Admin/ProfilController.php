<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Session;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.profil.index');
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
        $user = Utilisateur::find($id);

        return view('admin.profil.index')->with('u', $user);

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


        return view('admin.profil.edit');
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
        $utilisateur = User::find($id);

        $this->validate($request, [
          'name' => 'required',
          'prenom' => 'required',
          'email' => 'required',
          'niveau' => 'required'
        ]);

        if($request->email != $utilisateur->email)
        {
          $this->validate($request, [
            'email' => 'unique:users'
          ]);
        }

        if(!empty($request->password))
        {
          $this->validate($request, [
            'password' => 'confirmed'
          ]);
        }

        $utilisateur->name = $request->name;
        $utilisateur->prenom = $request->prenom;
        $utilisateur->email = $request->email;
        $utilisateur->password = $request->pass;

        if(!empty($request->password))
        {
          $utilisateur->password = bcrypt($request->password);
        }

        $utilisateur->niveau = $request->niveau;
        $utilisateur->save();
        Session::flash('success', 'Votre profil est modifié avec succé !');
        return redirect()->route('admin.profil.index');

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
    }
}
