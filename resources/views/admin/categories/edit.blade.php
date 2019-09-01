@extends('layouts.admin')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION CATEGORIE </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.categories.modifier' , $categorie->id) }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6">
                <input type="text" name="codecategorie" class="form-control {{ $errors->has('codecategorie') ? 'is-invalid' : ''}}" value="{{ $categorie->codeCategorie}}">
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
              <div class="col-md-6"><input type="text" name="categorie" class="form-control {{ $errors->has('categorie') ? 'is-invalid' : ''}}" value="{{ $categorie->categorie }}">
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
            <input type="submit" class="btn btn-warning" value="MODIFIER" style="background: #FF9500; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
