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

    <div class="card card-default">
      <div class="card-header text-center">
        <h2 class="text-center">LISTE DES ARTICLES RECUS </h2>
      </div>

      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Bordereau Fournisseur</th>
            <th>Article</th>
            <th>Utilisateurs</th>
            <th>Action</th>
          </tr>
          @if($articlerecus->count() > 0)

            @foreach($articlerecus as $atr)
              <tr>
                @foreach($brd as $b)
                  @if($atr->idbrdfourniss == $b->id)
                    <td>{{ $b->fichier}}</td>
                  @endif
                @endforeach

                @foreach($articles as $at)
                  @if($atr->idarticle == $at->id)
                    <td>{{ $at->article }}</td>
                  @endif
                @endforeach

                @foreach($users as $u)
                  @if($atr->iduser == $u->id)
                    <td>{{ $u->email }}</td>
                  @endif
                @endforeach
                <td>

                  <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$atr->id}}" data-brd="{{ $b->fichier }}"
                     data-article="{{$at->article}}" data-user="{{$u->email}}"
                     data-qte="{{ $atr->qte }}" data-couleur="{{ $atr->couleur}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ route('admin.articlerecus.edit', $atr->id) }}" class="btn btn-warning btn-sm" data-id="{{$atr->id}}">
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
              <th colspan="6" class="text-center"> Aucun article reçus !</th>
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
                    <label for="">BORDEREAU FOURNISSEUR :</label>
                    <input type="val" class="form-control" id="brd" disabled>
                </div>
                <div class="form-group">
                    <label for="">ARTICLE :</label>
                    <input type="val" class="form-control" id="article" disabled>
                </div>
                <div class="form-group">
                    <label for="">UTILISATEUR :</label>
                    <input type="val" class="form-control" id="user" disabled>
                </div>
                <div class="form-group">
                    <label for="">QUANTITE :</label>
                    <input type="val" class="form-control" id="qte" disabled>
                </div>
                <div class="form-group">
                    <label for="">COULEUR :</label>
                    <input type="val" class="form-control" id="couleur" disabled>
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
    $('#brd').val($(this).data('brd'));
    $('#article').val($(this).data('article'));
    $('#user').val($(this).data('user'));
    $('#qte').val($(this).data('qte'));
    $('#couleur').val($(this).data('couleur'));
    $('.modal-title').text('Details Article reçus');
});
</script>
@endsection
