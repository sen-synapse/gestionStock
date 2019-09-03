@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
  

    <div class="card card-default">
      <div class="card-header text-center">
        <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">BORDEREAUX LIVRAISON</h3>
      </div>
      <div class="row">
      <div class="col-md-4 col-sm-3">
      <a href="#" 
            class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU BORDEREAU</a>
      </div>

    </div> 
    <br>

      <div class="card-body">
        <table class="table table-striped">
          <tr>

            <th>Client </th>
            <th>Date Bordereau  </th>
                <th>Nom Fichier </th>
            <th>Action</th>
          </tr>
          @if(count($bdl))
            @foreach($bdl as $n)
              @foreach($cl as $c)
                @if($c->id == $n->idclient)
                <tr>
                  <td> {{ $c->prenom}} - {{ $c->nom }} - {{ $c->telephone }} </td>
                  <td>{{ $n->datebrd }}</td>
                  <td>{{ $n->fichier }}</td>

                  <td>
                        <a href="#" class="btn btn-success btn-sm"
                        style="box-shadow: 0px 0px 15px #95A5A6; background: #87CB16; color: #fff;">
                            <i class="fa fa-plus"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                            data-fichier="{{$n->fichier}}">
                            <i class="fa fa-eye"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"
                        style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                            <i class="fa fa-trash"></i>
                        </a>
                     <form action="{{ route('admin.bordereaulivraison.destroy',$n->id) }}" method="post">
                      @method('DELETE')
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                  </td>
                </tr>
              @endif
            @endforeach
          @endforeach
          @else
          <tr><th colspan="4" class="text-center">Aucun Bordereau Enregistr&eacute; !</th></tr>
          @endif
        </table>
      </div>
    </div>


    <div id="showmodalF" class="modal fade" role="dialog">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 100%;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" style="color: #fff; font-size: 30px;">&times;</button>
                  <h4 class="modal-title text-center" style="color: #fff;">Bordereau Livraison</h4>  
                </div>
                <div class="modal-body" style=" height: 80vh;">

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
                <form  method="post" action="{{ route('admin.bordereaulivraison.store') }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">Clients : </label>
                        <div class="col-md-6">
                          <select class="form-control" name="client">
                            @foreach(App\Models\Client::all() as $cl)
                              <option value="{{$cl->id}}">{{ $cl->prenom }} - {{ $cl->nom }} - {{ $cl->telephone }}</option>
                            @endforeach
                            </select>
                      
                        </div>
                        <div id="list"></div>
                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">Date : </label>
                        <div class="col-md-6"><input type="date" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : ''}}" value="{{ old('date')}}">
                          @if($errors->has('date'))
                            <div class="text-center text-danger">
                              {{ $errors->first('date')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">Fichier : </label>
                        <div class="col-md-6"><input type="file" name="fichier" class="form-control {{ $errors->has('fichier') ? 'is-invalid' : ''}}" value="old('fichier')">
                          @if($errors->has('fichier'))
                            <div class="text-center text-danger">
                              Veuillez-choisir un fichier PDF
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
            $('.modal-title').text('Echec de l\'ajout Bordereau Livraison !');
            $('.modal-header').css('background', '#FF4A55');
          });
        
        </script> 
      @endif
</section>

<script src="{{ asset('js/pdfobject.min.js') }}"> </script>

<script>

    // Show function Fournisseur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');

        var fichier = '{{ asset('uploads/bordereaulivraison/')}} ' + '/' + $(this).data('fichier');

        PDFObject.embed(fichier, '.modal-body');
        $('.modal-header').css('background', '#1DC7EA');
    }); 

    $(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter Bordereau Fournisseur');
        $('.modal-header').css('background', '#1D62F0');
    }); 
</script>
@endsection
