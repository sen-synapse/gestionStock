@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active"><b>utilisateurs</b></li>
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
        <h2>VOTRE PROFIL </h2>
      </div>

      <div class="card-body">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Nom : </label>
              <div class="col-md-6">
                <input type="text" name="nom" class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{ Auth::user()->name }}" disabled>
                @if($errors->has('prenom'))
                <div class="text-center text-danger">
                  {{ $errors->first('prenom') }}
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Prenom : </label>
              <div class="col-md-6">
                <input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{ Auth::user()->prenom }}" disabled>
                @if($errors->has('prenom'))
                <div class="text-center text-danger">
                  {{ $errors->first('prenom') }}
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Login : </label>
                <div class="col-md-6"><input type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ Auth::user()->email }}" disabled>
                  @if($errors->has('email'))
                    <div class="text-center text-danger">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Perimission : </label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="" value="niveau {{ Auth::user()->niveau }}" disabled>
              </div>
           </div>
          </div>
          <div class="form-group text-center">
            <a href="{{ route('admin.profil.edit' , Auth::user()->id) }}" class="btn btn-primary">Modifier votre profil</a>
      </div>
    </div>

  </div>
</section>
       {{--$utilisateurs->links()--}}
    {{-- Modal Form Show POST --}}
    <div id="showmodalF" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align: center; color: #2a88bd;"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="form-group">
                      <label for="">IDENTIFIANT </label>
                      <input type="val" class="form-control" id="id" disabled>
                  </div>

                  <div class="form-group">
                      <label for="">NOM </label>
                      <input type="val" class="form-control" id="nom" disabled>
                  </div>

                  <div class="form-group">
                      <label for="">PRENOM </label>
                      <input type="val" class="form-control" id="prenom" disabled>
                  </div>

                  <div class="form-group">
                      <label for="">LOGIN</label>
                      <input type="val" class="form-control" id="login" disabled>
                  </div>

                  <div class="form-group">
                      <label for="">PERMISSION </label>
                      <input type="val" class="form-control" id="niveau" disabled>
                  </div>
                </div>
            </div>
        </div>
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    // Show function utilisateur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');
        $('#id').val($(this).data('id'));
        $('#nom').val($(this).data('nom'));
        $('#prenom').val($(this).data('prenom'));
        $('#login').val($(this).data('login'));
        $('#niveau').val($(this).data('niveau'));
        $('.modal-title').text('Details Utilisateur');
    });
</script>
@endsection