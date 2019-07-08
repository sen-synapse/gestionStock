@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active">Ajouter un sous categorie </li>
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
        <h2>AJOUTER UN SOUS CATEGORIE </h2>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.souscategories.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6">
                <input type="text" name="codesouscat" class="form-control {{ $errors->has('codesouscat') ? 'is-invalid' : ''}}" value="{{ old('codesouscat')}}">
                @if($errors->has('codesouscat'))
                  <div class="text-center text-danger">
                    {{ $errors->first('codesouscat') }}
                  </div>
                @endif
              </div>

              <div class="clearfix"></div>
           </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Sous categorie : </label>
              <div class="col-md-6"><input type="text" name="souscategorie" class="form-control {{ $errors->has('souscategorie') ? 'is-invalid' : ''}}" value="{{ old('souscategorie')}}">
                @if($errors->has('souscategorie'))
                  <div class="text-center text-danger">
                    {{ $errors->first('souscategorie')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Catégorie : </label>
              <div class="col-md-6">
                <select class="form-control" name="idcategorie">
                  @foreach($categories as $c)
                  <option value="{{$c->id}}">{{ $c->categorie }}</option>
                  @endforeach
                </select>
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
