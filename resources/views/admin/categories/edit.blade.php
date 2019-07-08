@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active">Ajouter un article reçus </li>
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
        <h2>MODIFICATION CATEGORIE </h2>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.categories.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6">
                <input type="text" name="codecategorie" class="form-control {{ $errors->has('codecategorie') ? 'is-invalid' : ''}}" value="{{ old('codecategorie')}}">
              </div>
              @if($errors->has('codecategorie'))
                <div class="text-center text-danger">
                  {{ $errors->first('codecategorie') }}
                </div>
              @endif
              <div class="clearfix"></div>
           </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Categorie : </label>
              <div class="col-md-6"><input type="text" name="categorie" class="form-control {{ $errors->has('categorie') ? 'is-invalid' : ''}}" value="{{ old('categorie')}}">
                @if($errors->has('categorie'))
                  <div class="text-center text-danger">
                    {{ $errors->first('categorie')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>

          <div class="form-group text-center">
            <input type="submit" class="btn btn-info" value="MODIFIER">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
