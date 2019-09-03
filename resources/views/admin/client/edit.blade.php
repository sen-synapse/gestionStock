@extends('layouts.admin')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION CLIENT</h3>
      </div>
      <div class="card-body">
        <form method="post" class="col-sm-offset-1" action="{{ route('admin.client.update', ['id' => $cl->id ]) }}">
          @method('PUT')
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">NOM </label>
                        <div class="col-md-8"><input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'invalid' : ''}}" value="{{ $cl->nom }}">
                          @if($errors->has('nom'))
                            <div class="text-center text-danger">
                              {{ $errors->first('nom')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                  <div class="row">
                        <label class="col-md-3">PRENOM </label>
                        <div class="col-md-8"><input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : ''}}" value="{{ $cl->prenom }}">
                          @if($errors->has('prenom'))
                            <div class="text-center text-danger">
                              {{ $errors->first('prenom')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">ADRESSE </label>
                        <div class="col-md-8"><input type="text" name="adresse" class="form-control {{ $errors->has('adresse') ? 'is-invalid' : ''}}" value="{{ $cl->adresse }}">
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
                        <label class="col-md-3">TELEPHONE </label>
                        <div class="col-md-8"><input type="text" name="tel" class="form-control {{ $errors->has('tel') ? 'is-invalid' : ''}}" value="{{ $cl->telephone }}">
                        @if($errors->has('tel'))
                            <div class="text-center text-danger">
                              Veuillez saisir un numéro de téléphone
                            </div>
                        @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </div>
          <div class="form-group text-center">
            <input type="submit" class="btn btn-warning" value="MODIFIER" style="background: #FF9500; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
