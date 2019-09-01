@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
<section class="content">
  <div class="container-fluid">

    <div class="card card-default">
      <div class="card-header text-center">
        <h4 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">ARTICLES RECUS EN FONCTION ARTICLE ET QUANTITE</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Article</th>
            <th>Utilisateurs</th>
            <th>Somme des quantités</th>
            <th>Couleur</th>
            <th>Action</th>
          </tr>
          @if(sizeof($articlerecus) > 0)

            @foreach($articlerecus as $atr)
                
              <tr>
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

                <td> {{ $atr->qte}}</td>
                <td> {{ $atr->couleur }}</td>
                <td>

                  <a href="{{ route('admin.articlerecus.details', [ 'art' => $atr->idarticle, 'couleur' => $atr->couleur ] ) }}"
                  style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                  class="btn btn-info btn-sm">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

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
    <div class="">
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
