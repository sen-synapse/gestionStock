@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
 
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">SOUS CATEGORIES </h3>
      </div>
      <div class="row">
          <div class="col-md-4 col-sm-3">
          <a href="#" 
                class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU SOUS CATEGORIE</a>
          </div> 
          <div class="col-md-7 ">
              <input id="myInput" type="search" placeholder="Rechercher Utilisateur" class="form-control filtre" align="center"
              style="border-top: none;border-left: none;border-right: none;"> 
          </div> 
      </div> 
      <br>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <th>Code</th>
            <th>Sous categorie</th>
            <th>Categorie</th>
            <th>Action</th>
          </thead> 
         
          @if($souscategories->count() > 0)
            <tbody id="tbody">
              @foreach($souscategories as $sc)
                <tr>
                  <td>{{ $sc->codesouscat }}</td>
                  <td>{{ $sc->souscategorie }}</td>
                  @foreach($categories as $c)
                    @if($sc->idcategorie == $c->id)
                      <td>{{ $c->categorie }}</td>
                    @endif
                  @endforeach
                  <td>

                    <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                      data-id="{{$sc->id}}" data-code="{{$sc->codesouscat}}" data-sc="{{$sc->souscategorie}}"
                      data-categorie="{{$c->categorie}}">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="{{ route('admin.souscategories.edit', $sc->id) }}" class="btn btn-warning btn-sm" data-id="{{$sc->id}}"
                    style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;">
                        <i class="fa fa-pencil"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"
                    style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                        <i class="fa fa-trash"></i>
                    </a>
                  <form action="{{ route('admin.souscategories.destroy',$sc->id) }}" method="post">
                    @method('DELETE')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </form>
                  </td>
                </tr>
              @endforeach
          @else
              <tr>
                <th colspan="4" class="text-center"> Aucun sous catégorie !</th>
              </tr> 
            </tbody>
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
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; fonct-size: 30px;">&times;</button>
                <h4 class="modal-title" style="align-content: center; color: #fff;"></h4>
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
                    <label for="">SOUS CATEGORIE :</label>
                    <input type="val" class="form-control" id="sc" disabled>
                </div>
                <div class="form-group">
                    <label for="">CATEGORIE :</label>
                    <input type="val" class="form-control" id="categorie" disabled>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="showmodalAdd" class="modal fade" role="dialog" tabindex="-1" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header" style="background: #1D62F0;">
                  <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
                  <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
                </div>
                <div class="modal-body"> 
                <form method="post" action="{{ route('admin.souscategories.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
           <div class="row">
              <label class="col-md-3">Code : </label>
              <div class="col-md-6">
                <input type="text" name="codesouscat" class="form-control {{ $errors->has('codesouscat') ? 'is-invalid' : ''}}" value="{{ old('codesouscat')}}">
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
              <div class="col-md-6"><input type="text" name="souscategorie" class="form-control {{ $errors->has('souscategorie') ? 'is-invalid' : ''}}" value="{{ old('souscategorie')}}">
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
                  <option value="{{$c->id}}">{{ $c->categorie }}</option>
                  @endforeach
                </select>
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
    $('#sc').val($(this).data('sc'));
    $('#categorie').val($(this).data('categorie'));
    $('.modal-title').text('Details Sous Catégorie');
    $('.modal-header').css('background', '#1DC7EA');
}); 

$(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter Fournisseur');
        $('.modal-header').css('background', '#1D62F0');
    }); 
</script> 

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
        });
    });
</script>
@endsection
