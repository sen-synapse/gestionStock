@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">

    <div class="card card-default">
      <div class="card-header">
      <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">CATEGORIES</h3>
      </div>
      <div class="row">
          <div class="col-md-4 col-sm-3">
          <a href="#" 
                class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU CATEGORIE</a>
          </div>

      </div>
          <br>
      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Code</th>
            <th>Categorie</th>
            <th>Action</th>
          </tr>

          @if($categories->count() > 0 )
          @foreach($categories as $c)
            <tr>
              <td>{{ $c->codeCategorie }}</td>
              <td>{{ $c->categorie }}</td>
              <td>

                <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$c->id}}" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                   data-code="{{$c->codeCategorie}}" data-categorie="{{$c->categorie}}">
                    <i class="fa fa-eye"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="{{ route('admin.categories.edit', $c->id) }}" class="btn btn-warning btn-sm" data-id="{{$c->id}}"
                style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;">
                    <i class="fa fa-pencil"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"
                style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                    <i class="fa fa-trash"></i>
                </a>
               <form action="{{ route('admin.categories.destroy',$c->id) }}" method="post">
                @method('DELETE')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </td>
            </tr>
          @endforeach
          @else
            <tr>
              <th colspan="3" class="text-center">Aucun Catégorie !</th>
            </tr>
          @endif

        </table>
      </div>
    </div>


  </div>
</section>
{{-- Modal Form Show POST --}}
<div id="showmodalF" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; font-size: 30px;">&times;</button>
                <h4 class="modal-title text-center" style="color: #fff;"></h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">IDENTIFIANT :</label>
                    <input type="val" class="form-control" id="id" disabled>
                </div>
                <div class="form-group">
                    <label for="">CODE :</label>
                    <input type="val" class="form-control" id="code" disabled>
                </div>
                <div class="form-group">
                    <label for="">CATEGORIE :</label>
                    <input type="val" class="form-control" id="categorie" disabled>
                </div>
            </div>
        </div>
    </div>
</div>


      <!--  FORMULAIRE D'AJOUT -->
      <div id="showmodalAdd" class="modal fade" role="dialog" tabindex="-1" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header" style="background: #1D62F0;">
                  <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
                  <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
                </div>
                <div class="modal-body"> 
                <form method="post" action="{{ route('admin.categories.store') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                  <div class="row">
                      <label class="col-md-3">Code : </label>
                      <div class="col-md-6">
                        <input type="text" name="codecategorie" class="form-control {{ $errors->has('codecategorie') ? 'is-invalid' : ''}}" value="{{ old('codecategorie')}}">
                      @if($errors->has('codecategorie'))
                        <div class="text-center text-danger">
                          {{ $errors->first('codecategorie') }}
                        </div>
                      @endif 
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  </div>

                  <div class="form-group">
                  <div class="row">
                      <label class="col-md-3">Categorie : </label>
                      <div class="col-md-6">
                        <input type="text" name="categorie" class="form-control {{ $errors->has('categorie') ? 'is-invalid' : ''}}" value="{{ old('categorie')}}">
                        
                      @if($errors->has('categorie'))
                          <div class="text-center text-danger">
                            {{ $errors->first('categorie')}}
                          </div>
                        @endif
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  </div>

                   <div class="form-group  text-center">
                      <input type="submit" class="btn btn-primary" value="AJOUTER" style="background: #1D62F0; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div> 

    @if($errors->count())
        <script>
          $(document).ready(function() {
            $('#showmodalAdd').modal('show');
            $('.modal-title').text('Echec de l\'ajout Fournisseur !');
            $('.modal-header').css('background', '#FF4A55');
          });
        
        </script> 
      @endif
<script>
// Show function Fournisseur
$(document).on('click', '.show-modal', function() {
    $('#showmodalF').modal('show');
    $('#id').val($(this).data('id'));
    $('#code').val($(this).data('code'));
    $('#categorie').val($(this).data('categorie'));
    $('.modal-title').text('Details Catégorie');
    $('.modal-header').css('background', '#1DC7EA');
}); 


$(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter Fournisseur');
        $('.modal-header').css('background', '#1D62F0');
    }); 

</script>
@endsection
