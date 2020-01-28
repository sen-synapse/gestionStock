@extends('layouts.admin')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header val-center">
        <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">VENTES REALISEES </h3>
      </div>

      <div class="card-body">
        <table class="table table-striped" id="datatable">
      		<thead>
      			<th>Article</th>
      			<th>Client</th>
      			<th>Quantité</th>
      			<th>Action</th>
      		</thead>
            <tbody id="tbody">
            @if($ventes->count() > 0)
          @foreach($ventes as $v)
            <tr>
            @foreach($articles as $article)
                @if($v->idarticle == $article->id)
                    <td>{{ $article->article }}</td>
                @endif
            @endforeach

            @foreach($brdliv as $b)
                @if($v->idbrdliv == $b->id)
                    <td>{{
                            App\Models\Client::find($b->idclient)->prenom
                            .' '.
                            App\Models\Client::find($b->idclient)->nom
                            .' - '.
                            App\Models\Client::find($b->idclient)->telephone
                        }}
                        <?php break; ?>
                    </td>
                @endif
            @endforeach

              <td>{{ $v->qte }}</td>
              <td>
                  <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                     data-idvente="{{ $v->id }} "data-article="{{$article->article}}"
                     data-client="{{ App\Models\Client::find($b->idclient)->prenom .' - '. App\Models\Client::find($b->idclient)->nom .' - '. App\Models\Client::find($b->idclient)->telephone}}"
                     data-qte="{{$v->qte}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ route('admin.vente.edit', $v->id) }}" class="show-modal-edit btn btn-warning btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="javascript:void(0)" onclick="prompt('Voulez-vous vraiment supprimer cette ligne ?') ? $(this).parent().find('form').submit() ; " class="btn btn-danger btn-sm"  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                      <i class="fa fa-trash"></i>
                  </a>
                  <form action="{{ route('admin.vente.destroy', $v->id) }}" method="post">
                    @method('DELETE')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </td>
            </tr>
          @endforeach
          @else
          <tr>
            <th colspan="5" class="text-center"> Aucune vente !</th>
          </tr>
          @endif

            </tbody>

      	</table>
      </div>
    </div>

  </div>


</section>
       {{--$fournisseurs->links()--}}
    {{-- Modal Form Show POST --}}
    <div id="showmodalF" class="modal fade" role="dialog" tabindex="-1" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header" style="background: #1DC7EA;">
                  <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
                  <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <label for="">IDENTIFIANT : </label>
                        <input type="val" class="form-control" id="idvente" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">ARTICLE:</label>
                        <input type="val" class="form-control" id="article" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">CLIENT :</label>
                        <input type="val" class="form-control" id="client" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">QUANTITE :</label>
                        <input type="val" class="form-control" id="qte" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Show function Fournisseur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');
        $('#idvente').val($(this).data('idvente'));
        $('#article').val($(this).data('article'));
        $('#client').val($(this).data('client'));
        $('#qte').val($(this).data('qte'));
        $('.modal-title').text('Details de la vente');
        $('.modal-header').css('background', '#1DC7EA');
    });
    $('#datatable').dataTable();
</script>

@endsection
