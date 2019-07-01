@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active">Nouveau Bordereau</li>
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
        <h2>AJOUTER UN BORDEREAU</h2>
      </div>

      <div class="card-body">
        <form method="post" action="{{ route('admin.bordereaufournisseurs.store') }}" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">


          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Fournisseurs : </label>
              <div class="col-md-6">
                <select name="fournisseur_id" class="form-control">
                  @foreach($fournisseurs as $c)
                    <option value="{{ $c->id }}" @if(old('fournisseur_id') == $c->id) selected @endif>{{ $c->raisonsocial }}</option>
                  @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Date : </label>
              <div class="col-md-6"><input type="date" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : ''}}" value="{{ old('date')}}">
                @if($errors->has('date'))
                  <div class="text-center text-danger">
                    {{ $errors->first('date')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Fichier : </label>
              <div class="col-md-6"><input type="file" name="fichier" class="form-control {{ $errors->has('fichier') ? 'is-invalid' : ''}}" value="old('fichier')">
                @if($errors->has('fichier'))
                  <div class="text-center text-danger">
                    Veuillez-choisir un fichier PDF
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
