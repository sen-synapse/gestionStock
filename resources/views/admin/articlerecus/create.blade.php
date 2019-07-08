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
        <h2>AJOUTER UN ARTICLE RECUS</h2>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.articlerecus.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                  <input type="hidden" name="idbrd" class="form-control" value="{{ $brd->id}}">
                </div>
            </div>

          </div>
          <div class="form-group">

            <div class="row">
              <label class="col-md-3">Article : </label>
              <div class="col-md-6">

                <select class="form-control" name="idarticle">
                  @foreach($articles as $article)
                    <option value="{{ $article->id}}">{{ $article->article }}</option>
                  @endforeach
                </select>

              </div>
              <div class="clearfix"></div>
            </div>

          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="iduser" class="form-control" value="{{ Auth::user()->id }}">
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Quantité : </label>
              <div class="col-md-6"><input type="text" name="qte" class="form-control {{ $errors->has('qte') ? 'is-invalid' : ''}}" value="{{ old('qte')}}">
                @if($errors->has('qte'))
                  <div class="text-center text-danger">
                    {{ $errors->first('qte')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>


          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Couleur : </label>
              <div class="col-md-6"><input type="text" name="couleur" class="form-control {{ $errors->has('couleur') ? 'is-invalid' : ''}}" value="{{ old('couleur')}}">
                @if($errors->has('couleur'))
                  <div class="text-center text-danger">
                    {{ $errors->first('couleur')}}
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
