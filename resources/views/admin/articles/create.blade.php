@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active">Ajouter un article</li>
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
        <h2>AJOUTER UN ARTICLE </h2>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.articles.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">

            <div class="row">
              <label class="col-md-3">Sous categorie : </label>
              <div class="col-md-6">
                <select class="form-control" name="idsoucat">
                  @foreach($souscategories as $sc)
                    <option value="{{$sc->id}}">{{ $sc->souscategorie }}</option>
                  @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6"><input type="text" name="codearticle" class="form-control {{ $errors->has('codearticle') ? 'is-invalid' : ''}}" value="{{ old('codearticle')}}">
                @if($errors->has('codearticle'))
                  <div class="text-center text-danger">
                    {{ $errors->first('codearticle')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>



          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Article : </label>
              <div class="col-md-6"><input type="text" name="article" class="form-control {{ $errors->has('article') ? 'is-invalid' : ''}}" value="{{ old('article')}}">
                @if($errors->has('article'))
                  <div class="text-center text-danger">
                    {{ $errors->first('article')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>


          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Nombre Article : </label>
              <div class="col-md-6"><input type="text" name="unitearticle" class="form-control {{ $errors->has('unitearticle') ? 'is-invalid' : ''}}" value="{{ old('unitearticle')}}">
                @if($errors->has('unitearticle'))
                  <div class="text-center text-danger">
                    {{ $errors->first('unitearticle')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
           </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Dimension : </label>
              <div class="col-md-6"><input type="text" name="dimension" class="form-control {{ $errors->has('dimension') ? 'is-invalid' : ''}}" value="{{ old('dimension')}}">
                @if($errors->has('dimension'))
                  <div class="text-center text-danger">
                    {{ $errors->first('dimension')}}
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
