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
        <h2>AJOUTER UN FOURNISSEUR</h2>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.fournisseurs.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Raison Social : </label>
              <div class="col-md-6"><input type="text" name="raisonsocial" class="form-control {{ $errors->has('raisonsocial') ? 'is-invalid' : ''}}" value="{{ old('raisonsocial')}}">
                @if($errors->has('raisonsocial'))
                  <div class="text-center text-danger">
                    {{ $errors->first('raisonsocial')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">
         <div class="row">
              <label class="col-md-3">Email : </label>
              <div class="col-md-6"><input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email')}}">
                @if($errors->has('email'))
                  <div class="text-center text-danger">
                    {{ $errors->first('email')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">
          <div class="row">
              <label class="col-md-3">Telephone : </label>
              <div class="col-md-6"><input type="tel" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : ''}}" value="{{ old('telephone')}}">
                @if($errors->has('telephone'))
                  <div class="text-center text-danger">
                    Veuillez saisir un numéro de téléphone
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Adresse : </label>
              <div class="col-md-6"><input type="text" name="adresse" class="form-control {{ $errors->has('adresse') ? 'is-invalid' : ''}}" value="{{ old('adresse')}}">
                @if($errors->has('adresse'))
                  <div class="text-center text-danger">
                    {{ $errors->first('adresse')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>
          <div class="form-group">
          <div class="row">
              <label class="col-md-3">Responsable : </label>
              <div class="col-md-6"><input type="text" name="responsable" class="form-control {{ $errors->has('responsable') ? 'is-invalid' : ''}}" value="{{ old('responsable')}}">
                @if($errors->has('responsable'))
                  <div class="text-center text-danger">
                    {{ $errors->first('responsable')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">
          <div class="row">
              <label class="col-md-3">Bureau Tel : </label>
              <div class="col-md-6"><input type="tel" name="bureautel" class="form-control {{ $errors->has('bureautel') ? 'is-invalid' : ''}}" value="{{ old('bureautel')}}">
                @if($errors->has('bureautel'))
                  <div class="text-center text-danger">
                    Veuillez saisir un numéro de téléphone
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">

          <div class="row">
              <label class="col-md-3">CODE : </label>
              <div class="col-md-6">
                <input type="text" name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" value="{{ old('code')}}">
                @if($errors->has('code'))
                  <div class="text-center text-danger">
                    {{ $errors->first('code')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="form-group">

          <div class="row">
              <label class="col-md-3">Numero Compte : </label>
              <div class="col-md-6"><input type="text" name="numcomptebank" class="form-control {{ $errors->has('numcomptebank') ? 'is-invalid' : ''}}" value="{{ old('numcomptebank')}}">
                @if($errors->has('numcomptebank'))
                  <div class="text-center text-danger">
                    Veuillez saisir un numéro de compte
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
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
