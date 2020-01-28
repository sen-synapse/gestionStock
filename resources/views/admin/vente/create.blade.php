@extends('layouts.admin')
@section('content')
    <!-- /.content-header -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center"  style="background: #87CB16;">
        <h4 class="modal-title" style="text-align: center; color: #fff;  padding: 20px;">ENREGISTREMENT DE LA VENTE</h4>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('admin.vente.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                  <input type="hidden" name="idbrdliv" class="form-control" value="{{ $brdliv->id}}">
                </div>
            </div>

          </div>

          <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                  <input type="hidden" name="login" class="form-control" value="{{ Auth::user()->email }}">
                </div>
            </div>

          </div>
          <div class="form-group">

            <div class="row">
              <label class="col-md-3">Article : </label>
              <div class="col-md-6">
                <div class="form-input">
                  <input type="text" name="articles" id="articles" class="form-control" placeholder="Entrez un article" />
                  <div id="articleListe"></div>
                  @if($errors->has('articles'))
                    <div class="text-center text-danger">
                      {{ $errors->first('articles')}}
                    </div>
                  @endif
                </div>

              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Couleur : </label>
              <div class="col-md-6">

                <select class="form-control" name="couleur">
                  @foreach($ars as $ar)
                    <option value="{{ $ar->couleur}}">{{ $ar->couleur }}</option>
                  @endforeach
                </select>
              </div>
              {{ csrf_field() }}
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

          <div class="form-group text-center">
            <input type="submit" class="btn btn-sucess" value="AJOUTER" style="background: #87CB16; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>
</section>

  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function(){
      $('#articles').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
          var _token = $('input[name="_token"]').val();
          $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {query:query, _token:_token},
            url: '/autocomplete-articles',
            success:function(data)
            {
              rows = '<ul class="nav nav-bar" style="display:block;position:relative;">';
              $.each(data, function(key, value){
                rows += '<li class="nav-item" ><a class="nav-link" style="color: #000;" href="#">'+ value.article + '</a></li>';
              });
              rows += '</ul>';

              $('#articleListe').fadeIn();
              $('#articleListe').html(rows);
            }
          })
        }
      });

      $(document).on('click', 'li', function(){
        $('#articles').val($(this).text());
        $('#articleListe').fadeOut();
      });
    });

  </script>
@endsection
