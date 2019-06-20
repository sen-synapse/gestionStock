@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Nouveau Fournisseur</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Ajouter Fournisseur</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <form method="post" action="{{ route('admin.fournisseurs.store') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <div class="row">
          <label class="col-md-3">Raison Social : </label>
          <div class="col-md-6"><input type="text" name="raisonsocial" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">
     <div class="row">
          <label class="col-md-3">Email : </label>
          <div class="col-md-6"><input type="email" name="email" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">
      <div class="row">
          <label class="col-md-3">Telephone : </label>
          <div class="col-md-6"><input type="tel" name="telephone" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">
       <div class="row">
          <label class="col-md-3">Adresse : </label>
          <div class="col-md-6"><input type="text" name="adresse" class="form-control"></div>
          <div class="clearfix"></div>
       </div>
      </div>
      <div class="form-group">
      <div class="row">
          <label class="col-md-3">Responsable : </label>
          <div class="col-md-6"><input type="text" name="responsable" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">
      <div class="row">
          <label class="col-md-3">Bureau Tel : </label>
          <div class="col-md-6"><input type="tel" name="bureautel" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">

      <div class="row">
          <label class="col-md-3">Fax : </label>
          <div class="col-md-6"><input type="text" name="fax" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">

      <div class="row">
          <label class="col-md-3">Numero Compte : </label>
          <div class="col-md-6"><input type="text" name="numcomptebank" class="form-control"></div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-info" value="AJOUTER">
      </div>
    </form>

  </div>
</section>  


@endsection