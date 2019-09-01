@extends('layouts.admin')
@section('content')

    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFFICATION SOUS CATEGORIE </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.souscategories.update', $souscategorie->id) }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6">
                <input type="text" name="codesouscat" class="form-control {{ $errors->has('codesouscat') ? 'is-invalid' : ''}}" value="{{ $souscategorie->codesouscat}}">
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
              <div class="col-md-6"><input type="text" name="souscategorie" class="form-control {{ $errors->has('souscategorie') ? 'is-invalid' : ''}}" value="{{ $souscategorie->souscategorie}}">
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
                  <option value="{{$c->id}}"
                    @if($c->id == $souscategorie->idcategorie)
                      selected
                    @endif
                    >{{ $c->categorie }}</option>
                  @endforeach
                </select>
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
