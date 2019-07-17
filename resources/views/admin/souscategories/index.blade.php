@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active">Sous Categories</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
  	<p>
  		<a href="{{ route('admin.souscategories.create') }}" class="btn btn-primary">NOUVEAU SOUS CATEGORIE</a>
  	</p>

    <div class="card card-default">
      <div class="card-header text-center">
        <h2 class="text-center">LISTE DES SOUS CATEGORIES </h2>
      </div>

      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Code</th>
            <th>Sous categorie</th>
            <th>Categorie</th>
            <th>Action</th>
          </tr>
          @if($souscategories->count() > 0)

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

                  <a href="#" class="show-modal btn btn-info btn-sm"
                    data-id="{{$sc->id}}" data-code="{{$sc->codesouscat}}" data-sc="{{$sc->souscategorie}}"
                    data-categorie="{{$c->categorie}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ route('admin.souscategories.edit', $sc->id) }}" class="btn btn-warning btn-sm" data-id="{{$sc->id}}">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm">
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
                <h4 class="modal-title" style="align-content: center; color: #2a88bd;"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
// Show function Fournisseur
$(document).on('click', '.show-modal', function() {
    $('#showmodalF').modal('show');
    $('#id').val($(this).data('id'));
    $('#code').val($(this).data('code'));
    $('#sc').val($(this).data('sc'));
    $('#categorie').val($(this).data('categorie'));
    $('.modal-title').text('Details Sous Catégorie');
});
</script>
@endsection
