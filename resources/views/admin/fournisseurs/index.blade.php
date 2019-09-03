@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header val-center">
        <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">FOURNISSEURS </h3>
      </div>
      
      <div class="row">
        <div class="col-md-4 col-sm-3">
        <a href="#" 
              class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU FOURNISSEUR</a>
        </div>
  
  </div>
       <br> 
      <div class="card-body">
        <table class="table table-striped">
      		<tr>
      			<th>Code</th>
      			<th>Email</th>
      			<th>Telephone</th>
      			<th>Adresse</th>
      			<th>Action</th>
      		</tr>

          @if($fournisseurs->count() > 0)
          @foreach($fournisseurs as $c)
            <tr>
              <td>{{ $c->fax }}</td>
              <td>{{ $c->email }}</td>
              <td>{{ $c->telephone }}</td>
              <td>{{ $c->adresse }}</td>
              <td>
                  <a href="#" class="show-modal btn btn-info btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;"
                     data-rs="{{$c->raisonsocial}}" data-mail="{{$c->email}}"
                     data-tel="{{$c->telephone}}" data-addr="{{$c->adresse}}"
                     data-res="{{$c->responsable}}" data-br="{{$c->bureautel}}"
                     data-fax="{{$c->fax}}" data-comp="{{$c->numcomptebank}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ route('admin.fournisseurs.edit', $c->id) }}" class="show-modal-edit btn btn-warning btn-sm" style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;"> 
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;
               
                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                      <i class="fa fa-trash"></i>
                  </a>
                  <form action="{{ route('admin.fournisseurs.destroy',$c->id) }}" method="post">
                    @method('DELETE')
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>
              </td>
            </tr>
          @endforeach
          @else
          <tr>
            <th colspan="5" class="text-center"> Aucun Fournisseur Enregistré !</th>
          </tr>
          @endif

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
                        <label for="">RAISON SOCIAL :</label>
                        <input type="val" class="form-control" id="rs" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">EMAIL :</label>
                        <input type="val" class="form-control" id="mail" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">TELEPHONE :</label>
                        <input type="val" class="form-control" id="tel" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">ADRESSE :</label>
                        <input type="val" class="form-control" id="addr" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">NOM RESPONSABLE :</label>
                        <input type="val" class="form-control" id="resp" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">BUREAUTEL :</label>
                        <input type="val" class="form-control" id="br" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">CODE :</label>
                        <input type="val" class="form-control" id="fax" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">NUMCOMPTEBANK :</label>
                        <input type="val" class="form-control" id="comp" disabled>
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

                  <form method="post" action="{{ route('admin.fournisseurs.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">RAISON SOCIAL </label>
                        <div class="col-md-8"><input type="text" name="raisonsocial" class="form-control {{ $errors->has('raisonsocial') ? 'invalid' : ''}}" value="{{ old('raisonsocial')}}">
                          @if($errors->has('raisonsocial'))
                            <div class="text-center text-danger">
                              {{ $errors->first('raisonsocial')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                  <div class="row">
                        <label class="col-md-3">EMAIL </label>
                        <div class="col-md-8"><input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ old('email')}}">
                          @if($errors->has('email'))
                            <div class="text-center text-danger">
                              {{ $errors->first('email')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">TELEPHONE </label>
                        <div class="col-md-8"><input type="tel" name="telephone" class="form-control {{ $errors->has('telephone') ? 'is-invalid' : ''}}" value="{{ old('telephone')}}">
                          @if($errors->has('telephone'))
                            <div class="text-center text-danger">
                              Veuillez saisir un numéro de téléphone
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">ADRESSE  </label>
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
                        <label class="col-md-3">RESPONSABLE  </label>
                        <div class="col-md-8"><input type="text" name="responsable" class="form-control {{ $errors->has('responsable') ? 'is-invalid' : ''}}" value="{{ old('responsable')}}">
                          @if($errors->has('responsable'))
                            <div class="text-center text-danger">
                              {{ $errors->first('responsable')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">BUREAU TEL </label>
                        <div class="col-md-8"><input type="tel" name="bureautel" class="form-control {{ $errors->has('bureautel') ? 'is-invalid' : ''}}" value="{{ old('bureautel')}}">
                          @if($errors->has('bureautel'))
                            <div class="text-center text-danger">
                              Veuillez saisir un numéro de téléphone
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">

                    <div class="row">
                        <label class="col-md-3">CODE  </label>
                        <div class="col-md-8">
                          <input type="text" name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" value="{{ old('code')}}">
                          @if($errors->has('code'))
                            <div class="text-center text-danger">
                              {{ $errors->first('code')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="form-group">

                    <div class="row">
                        <label class="col-md-3">NUMERO COMPTE  </label>
                        <div class="col-md-8"><input type="text" name="numcomptebank" class="form-control {{ $errors->has('numcomptebank') ? 'is-invalid' : ''}}" value="{{ old('numcomptebank')}}">
                          @if($errors->has('numcomptebank'))
                            <div class="text-center text-danger">
                              Veuillez saisir un numéro de compte
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
            $('.modal-title').text('Echec de l\'ajout Fournisseur !');
            $('.modal-header').css('background', '#FF4A55');
          });
        
        </script> 
      @endif

        
<script>
    // Show function Fournisseur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');
        $('#rs').val($(this).data('rs'));
        $('#mail').val($(this).data('mail'));
        $('#tel').val($(this).data('tel'));
        $('#addr').val($(this).data('addr'));
        $('#resp').val($(this).data('res'));
        $('#br').val($(this).data('br'));
        $('#fax').val($(this).data('fax'));
        $('#comp').val($(this).data('comp'));
        $('.modal-title').text('Details Fournisseur');
        $('.modal-header').css('background', '#1DC7EA');
    }); 

    $(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter Fournisseur');
        $('.modal-header').css('background', '#1D62F0');
    }); 

</script>
@endsection
