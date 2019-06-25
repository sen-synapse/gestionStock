@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ajouter Bordereau</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
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
    <form method="post" action="{{ route('admin.bordereaufournisseurs.store') }}" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">


      <div class="form-group">
        <div class="row">
          <label class="col-md-3">Fournisseurs : </label>
          <div class="col-md-6">
            <select name="fournisseur_id" class="form-control">
              <option value="">Choisir le Fournisseur </option>
              @foreach($fournisseurs as $c)
                <option value="{{ $c->id }}">{{ $c->raisonsocial }}</option>
              @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-3">Date : </label>
          <div class="col-md-6"><input type="date" name="date" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-3">Fichier : </label>
          <div class="col-md-6"><input type="file" name="fichier" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>


      <div class="form-group">
        <input type="submit" class="btn btn-info" value="Save">
      </div>
    </form>
  </div>
</section>  


@endsection