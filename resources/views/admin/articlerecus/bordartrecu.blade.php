@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">LISTE DES ARTICLES RECUS</h3>
      </div> 
      <div class="row">
          <div class="col-md-4 col-sm-3">
          <a href="{{ route('admin.articlerecus.ajouter', ['id' => $brd->id] )}}" 
                class="show-modal-add btn btn-sm btn-success" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #87CB16; color: #fff;"><i class="fa fa-plus"></i>AJOUTER UN AUTRE ARTICLE RECU</a>
          </div>
  	  </div> 
      <br>
      <div class="card-body">
        <h5 class="text-center">DU FOURNISSEUR  DU {{ $brd->datebrd }} </h5>
        <table class="table table-striped">
          <tr>
            <th>Article</th>
            <th>Utilisateurs</th>
            <th>Quantité</th>
            <th>Couleur</th>
            <th>Action</th>
          </tr>
          @if($articlerecus->count() > 0)

            @foreach($articlerecus as $atr)
              <tr>

                @if($atr->idbrdfourniss == $brd->id)
                    @foreach($articles as $at)
                    @if($atr->idarticle == $at->id)
                        <td>{{ $at->article }}</td>
                        <?php break; ?>
                    @endif
                    @endforeach

                    @foreach($users as $u)
                    @if($atr->iduser == $u->id)
                        <td>{{ $u->email }}</td>
                        <?php break; ?>
                    @endif
                    @endforeach

                    <td> {{ $atr->qte}}</td>
                    <td> {{ $atr->couleur }}</td>
                    <td>

                    <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;" 
                        data-id="{{$atr->id}}" data-brd="{{ $brd->fichier }}"
                        data-article="{{$at->article}}" data-user="{{$u->email}}"
                        data-qte="{{ $atr->qte }}" data-couleur="{{ $atr->couleur}}">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="{{ route('admin.articlerecus.edit', $atr->id) }}" style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;" 
                       class="btn btn-warning btn-sm" data-id="{{$atr->id}}">
                        <i class="fa fa-pencil"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)" style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;" 
                       onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
                    <form action="{{ route('admin.articles.destroy',$at->id) }}" method="post">
                    @method('DELETE')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @endif
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
