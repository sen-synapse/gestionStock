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
  		<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">NOUVEAU ARTICLE </a>
  	</p>

    <div class="card card-default">
      <div class="card-header text-center">
        <h2 class="text-center">LISTE DES ARTICLES </h2>
      </div>
      <form class="row text-center col-sm-10 " action="{{ route('admin.articles.recherche') }}" method="get">

        <input type="text" class="typehead form-control col-sm-8 offset-sm-2" placeholder="recherccher un article " name="recherche" value="">

        <input type="submit" class="btn btn-primary" value="Recherche">

      </form>

      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Code</th>
            <th>Sous categorie</th>
            <th>Article</th>
            <th>Unité</th>
            <th>Dimension</th>
            <th>Action</th>
          </tr>
          @if($articles->count() > 0)

            @foreach($articles as $at)
              <tr>
                <td>{{ $at->codearticle }}</td>

                @foreach($souscategories as $sc)
                  @if($at->idsoucat == $sc->id)
                    <td>{{ $sc->souscategorie }}</td>
                  @endif
                @endforeach
                <td>{{ $at->article}}</td>
                <td>{{ $at->unitearticle}}</td>
                <td>{{ $at->dimension}}</td>
                <td>
                  <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$sc->id}}"
                     data-code="{{$at->codearticle}}" data-sc="{{$sc->souscategorie}}"
                     data-article="{{ $at->article }}" data-unite="{{ $at->unitearticle}}"
                     data-dimension="{{$at->dimension}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ route('admin.articles.edit', $at->id) }}" class="btn btn-warning btn-sm" data-id="{{$sc->id}}">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i>
                  </a>
                 <form action="{{ route('admin.articles.destroy',$at->id) }}" method="post">
                  @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <th colspan="6" class="text-center"> Aucun article !</th>
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
                    <label for="">ARTICLE :</label>
                    <input type="val" class="form-control" id="article" disabled>
                </div>
                <div class="form-group">
                    <label for="">UNITE :</label>
                    <input type="val" class="form-control" id="unite" disabled>
                </div>
                <div class="form-group">
                    <label for="">DIMENSION :</label>
                    <input type="val" class="form-control" id="dimension" disabled>
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
    $('#article').val($(this).data('article'));
    $('#unite').val($(this).data('unite'));
    $('#dimension').val($(this).data('dimension'));
    $('.modal-title').text('Details Article');
});
</script>
@endsection
