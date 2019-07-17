@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
          <li class="breadcrumb-item active"><b>Fournisseurs</b></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
  	<p>
  		<a href="{{ route('admin.fournisseurs.create') }}" class="btn btn-primary">NOUVEAU FOURNISSEUR</a>
  	</p>

    <div class="card card-default">
      <div class="card-header val-center">
        <h2 class="text-center">LISTE DES FOURNISSEURS </h2>
      </div>

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
                  <a href="#" class="show-modal btn btn-info btn-sm"
                     data-rs="{{$c->raisonsocial}}" data-mail="{{$c->email}}"
                     data-tel="{{$c->telephone}}" data-addr="{{$c->adresse}}"
                     data-res="{{$c->responsable}}" data-br="{{$c->bureautel}}"
                     data-fax="{{$c->fax}}" data-comp="{{$c->numcomptebank}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="{{ route('admin.fournisseurs.edit',$c->id) }}" class="btn btn-warning btn-sm">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm">
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
    <div id="showmodalF" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="align-content: center; color: #2a88bd;"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
    });
</script>
@endsection
