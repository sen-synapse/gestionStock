@extends('layouts.admin')
@section('content')

    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">

    <div class="card card-default">
      <div class="card-header text-center">
        <h4 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">ARTICLES RECUS ABIMEES </h4>
      </div>

  <br>
      <div class="card-body">
        <table  id="datatable" class="table table-striped">
          <thead>
            <th>Bordereau Fournisseur</th>
            <th>Article</th>
            <th>Utilisateurs</th>
            <th>Quantité abimée</th>
            <th>Couleur</th>
            <th>Action</th>
          </thead>
          <tbody id="tbody">
          @if($articlerecus->count() > 0)

            @foreach($articlerecus as $atr)

              <tr class=" <?php if($atr->qte < 10) { echo 'bg-danger'; }?>">
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

                <td>{{$atr->qteabimee}}</td>
                <td> {{ $atr->couleur }}</td>

                <td>

                <a href="#" class="show-modal-add btn btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #2196f3; color: #fff;" data-ida="{{$atr->id}}"
                     data-fourniss = "{{ $f->id }}" data-articlea="{{$at->id}}" data-usera="{{$u->id}}"
                     data-qtea="{{ $atr->qte }}" data-couleura="{{ $atr->couleur}}">
                      <i class="pe-7s-shield" style="font-size: 20px;"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;" data-id="{{$atr->id}}"
                     data-article="{{$at->article}}" data-user="{{$u->email}}"
                     data-qte="{{ $atr->qte }}" data-couleur="{{ $atr->couleur}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;


                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"
                  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                      <i class="fa fa-trash"></i>
                  </a>
                 <form action="{{ route('admin.articlesabimes.destroy',$atr->id) }}" method="post">
                  @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <th colspan="6" class="text-center"> Aucun article abimee !</th>
            </tr>
          @endif
        </tbody>
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

<div id="showmodalAdd" class="modal fade" role="dialog" tabindex="-1" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header" style="background: #1D62F0;">
                  <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
                  <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ route('admin.articlesabimes.store') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Quantites abimes  : </label>
                        <div class="col-md-6">
                          <input type="text" name="qteabime" class="form-control {{ $errors->has('qteabime') ? 'is-invalid' : ''}}" value="{{ old('qteabime')}}">
                        @if($errors->has('qteabime'))
                          <div class="text-center text-danger">
                            {{ $errors->first('qteabime') }}
                          </div>
                        @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                  </div>

                  <input type="hidden" class="form-control" id="ida" name="id">
                  <input type="hidden" class="form-control" id="fourniss" name="fourniss">
                  <input type="hidden" class="form-control" id="articlea" name="article">
                  <input type="hidden" class="form-control" id="usera" name="user">
                  <input type="hidden" class="form-control" id="qtea" name="qte">
                  <input type="hidden" class="form-control" id="couleura" name="couleur">

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
        $('.modal-title').text('Echec de l\'operation !');
        $('.modal-header').css('background', '#FF4A55');
      });

    </script>
@endif

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

$(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('#ida').val($(this).data('ida'));
        $('#fourniss').val($(this).data('fourniss'));
        $('#articlea').val($(this).data('articlea'));
        $('#usera').val($(this).data('usera'));
        $('#qtea').val($(this).data('qtea'));
        $('#couleura').val($(this).data('couleura'));
        $('.modal-title').text('Ajouter quantite abimee');
        $('.modal-header').css('background', '#1D62F0');
    });

      $('#datatable').dataTable();
</script>

@endsection
