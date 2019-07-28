@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
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
    <div class="card card-default">
      <div class="card-header text-center">
        <h2>AJOUTER UN BORDEREAU</h2>
      </div>

      <div class="card-body">
        <form  method="post" action="{{ route('admin.bordereaufournisseurs.store') }}" enctype="multipart/form-data">
         {{ csrf_field() }}
          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Fournisseurs : </label>
              <div class="col-md-6">
                <input type="text" name="raisonsocial" value="" id="raisonsocial" class="form-control">
              </div>
              <div id="list"></div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Date : </label>
              <div class="col-md-6"><input type="date" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : ''}}" value="{{ old('date')}}">
                @if($errors->has('date'))
                  <div class="text-center text-danger">
                    {{ $errors->first('date')}}
                  </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Fichier : </label>
              <div class="col-md-6"><input type="file" name="fichier" class="form-control {{ $errors->has('fichier') ? 'is-invalid' : ''}}" value="old('fichier')">
                @if($errors->has('fichier'))
                  <div class="text-center text-danger">
                    Veuillez-choisir un fichier PDF
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

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
  $(document).ready(function(){
    $('#raisonsocial').on('keyup', function(){

      var query = $(this).val();

        $.ajax({
          url:"{{ route('admin.bordereaufournisseurs.autocomplete') }}",
          type:"POST",
          data:{'raisonsocial':query},
          success:function (data)
          {
            
            $('#list').fadeIn();
            $('#list').html(data);
          }
        })
      
    });

  });
</script>

@endsection
