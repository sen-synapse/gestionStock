@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">


    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active">Ajouter Fournisseur</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
       <h2>NOUVEAU UTILISATEUR</h2>
      </div>

      <div class="card-body">
        <form method="post" action="{{ route('admin.utilisateurs.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Nom : </label>
              <div class="col-md-6"><input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name')}}">
                @if($errors->has('name'))
                <div class="text-center text-danger">
                  {{ $errors->first('name') }}
                </div>
                @endif
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Prenom : </label>
              <div class="col-md-6"><input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{ old('prenom')}}">
                @if($errors->has('prenom'))
                <div class="text-center text-danger">
                  {{ $errors->first('prenom') }}
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
         <div class="row">
              <label class="col-md-3">Login : </label>
              <div class="col-md-6"><input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email')}}">
                @if($errors->has('email'))
                <div class="text-center text-danger">
                  {{ $errors->first('email') }}
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">
          <div class="row">
              <label class="col-md-3">Mot de passe : </label>
                <div class="col-md-6"><input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"></div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Confirmer mot de passe : </label>
                <div class="col-md-6"><input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation">
                  @if($errors->has('password'))
                  <div class="text-center text-danger">
                    {{ $errors->first('password') }}
                  </div>
                  @endif
                </div>
              <div class="clearfix"></div>
           </div>
          </div>
          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Perimission : </label>
              <div class="col-md-6">
                <select class="form-control {{ $errors->has('niveau') ? 'is-invalid' : '' }}" name="niveau">
                  <option value="">Veuillez choisir le niveau de l'utilisateur</option>
                  <option value="1" @if(old('niveau') == 1) selected @endif>Niveau 1</option>
                  <option value="2" @if(old('niveau') == 2) selected @endif>Niveau 2</option>
                </select>
              </div>
           </div>
          </div>
          <div class="form-group text-center">
            <input type="submit" class="btn btn-info" value="AJOUTER">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
