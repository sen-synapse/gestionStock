@extends('layouts.admin')
@section('content')

    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION ARTICLE</h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.articles.update',  $article->id) }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">

            <div class="row">
              <label class="col-md-3">Sous categorie : </label>
              <div class="col-md-6">
                <select class="form-control" name="idsoucat">
                  @foreach($souscategories as $sc)
                    <option value="{{$sc->id}}"
                      @if($sc->id == $article->idsoucat)
                        selected
                      @endif
                      >{{ $sc->souscategorie }}</option>
                  @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6">
                <input type="text" name="codearticle" class="form-control {{ $errors->has('codearticle') ? 'is-invalid' : ''}}" value="{{ $article->codearticle}}">
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
              <div class="col-md-6"><input type="text" name="article" class="form-control {{ $errors->has('article') ? 'is-invalid' : ''}}" value="{{ $article->article}}">
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
              <div class="col-md-6"><input type="text" name="unitearticle" class="form-control {{ $errors->has('unitearticle') ? 'is-invalid' : ''}}" value="{{ $article->unitearticle}}">
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
              <div class="col-md-6"><input type="text" name="dimension" class="form-control {{ $errors->has('dimension') ? 'is-invalid' : ''}}" value="{{ $article->dimension}}">
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
            <input type="submit" class="btn btn-warning" value="MODIFIER" style="background: #FF9500; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
