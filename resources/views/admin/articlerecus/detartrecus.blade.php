@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
 
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">

    <div class="card card-default">
      <div class="card-header text-center">
      <h4 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">ARTICLES RECUS EN FONCTION DE L'ARTICLE ET LA COULEUR</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Bordereau Fournisseur</th>
            <th>Article</th>
            <th>Utilisateurs</th>
            <th>Quantité</th>
            <th>Couleur</th>
            <th>Action</th>
          </tr>
          @if($articlerecus->count() > 0)

            @foreach($articlerecus as $atr)
                
              <tr>
              @foreach($brd as $b)
                  @if($b->id == $atr->idbrdfourniss)
                    @foreach(App\Models\Fournisseur::all() as $f)
                      @if($b->idfourniss == $f->id)
                        <td>{{ $f->email }} -
                        {{ $b->datebrd }}</td> 
                      @endif 
                      @endforeach
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
                    <?php break; ?>
                  @endif
                @endforeach

                <td> {{ $atr->qte}}</td>
                <td> {{ $atr->couleur }}</td>
                <td>

                  <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;" data-id="{{$atr->id}}"
                     data-article="{{$at->article}}" data-user="{{$u->email}}"
                     data-qte="{{ $atr->qte }}" data-couleur="{{ $atr->couleur}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ route('admin.articlerecus.edit', $atr->id) }}" class="btn btn-warning btn-sm" data-id="{{$atr->id}}" 
                  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"
                  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                      <i class="fa fa-trash"></i>
                  </a>
                 <form action="{{ route('admin.articlerecus.destroy',$atr->id) }}" method="post">
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
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center" style=" color: #fff;"></h4>
               
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
    $('.modal-header').css('background', '#1DC7EA');
});
</script>
@endsection
