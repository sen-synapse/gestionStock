@extends('layouts.admin')
@section('content')

    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header val-center">
        <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">CLIENTS</h3>
      </div>

      <div class="row">
        <div class="col-md-4 col-sm-3">
        <a href="#"
              class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU CLIENT</a>
        </div>
  </div>
       <br>
      <div class="card-body">
        <table class="table table-striped" id="datatable">
      		<thead>
      			<th>Nom</th>
      			<th>Prenom</th>
      			<th>Adresse</th>
      			<th>Telephone</th>
      			<th>Action</th>
      		</thead>

          <tbody id="tbody">
          @if($clients->count() > 0)
            @foreach($clients as $c)
              <tr>
                <td>{{ $c->nom}}</td>
                <td>{{ $c->prenom }}</td>
                <td>{{ $c->adresse }}</td>
                <td>{{ $c->telephone }}</td>
                <td>
                    <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                      data-id="{{$c->id}}" data-nom="{{$c->nom}}" data-prenom="{{$c->prenom}}"
                      data-adresse="{{$c->adresse}}" data-tel="{{$c->telephone}}">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('admin.client.edit', $c->id) }}" class="show-modal-edit btn btn-warning btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;">
                        <i class="fa fa-pencil"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                        <i class="fa fa-trash"></i>
                    </a>
                    <form action="{{ route('admin.client.destroy',$c->id) }}" method="post">
                      @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </td>
              </tr>
            @endforeach
          @else
          <tr>
            <th colspan="5" class="text-center"> Aucun Client Enregistré !</th>
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
                        <label for="">IDENTIFIANT</label>
                        <input type="val" class="form-control" id="id" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">NOM </label>
                        <input type="val" class="form-control" id="nom" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">PRENOM</label>
                        <input type="val" class="form-control" id="prenom" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">ADRESSE :</label>
                        <input type="val" class="form-control" id="adresse" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">TELEPHONE :</label>
                        <input type="val" class="form-control" id="tel" disabled>
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

                  <form method="post" action="{{ route('admin.client.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">NOM </label>
                        <div class="col-md-8"><input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'invalid' : ''}}" value="{{ old('nom')}}">
                          @if($errors->has('nom'))
                            <div class="text-center text-danger">
                              {{ $errors->first('nom')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                  <div class="row">
                        <label class="col-md-3">PRENOM </label>
                        <div class="col-md-8"><input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? 'is-invalid' : ''}}" value="{{ old('prenom')}}">
                          @if($errors->has('prenom'))
                            <div class="text-center text-danger">
                              {{ $errors->first('prenom')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">ADRESSE </label>
                        <div class="col-md-8"><input type="text" name="adresse" class="form-control {{ $errors->has('adresse') ? 'is-invalid' : ''}}" value="{{ old('adresse')}}">
                        @if($errors->has('adresse'))
                            <div class="text-center text-danger">
                              {{ $errors->first('adresse')}}
                            </div>
                        @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">TELEPHONE </label>
                        <div class="col-md-8"><input type="text" name="tel" class="form-control {{ $errors->has('tel') ? 'is-invalid' : ''}}" value="{{ old('tel')}}">
                        @if($errors->has('tel'))
                            <div class="text-center text-danger">
                              Veuillez saisir un numéro de téléphone
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
            $('.modal-title').text('Echec de l\'ajout Client !');
            $('.modal-header').css('background', '#FF4A55');
          });
        </script>
      @endif


<script>
    // Show function Fournisseur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');
        $('#id').val($(this).data('id'));
        $('#nom').val($(this).data('nom'));
        $('#prenom').val($(this).data('prenom'));
        $('#adresse').val($(this).data('adresse'));
        $('#tel').val($(this).data('tel'));
        $('.modal-title').text('Details Client');
        $('.modal-header').css('background', '#1DC7EA');
    });

    $(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter Client');
        $('.modal-header').css('background', '#1D62F0');
    });
    $('#datatable').dataTable();
</script>

@endsection
