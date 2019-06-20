@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6" style="text-align: right; font-style: italic;">
        <h1 class="m-0 text-dark"><b>Liste Fournisseurs</b></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Dashboard</a></li>
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
  		<a href="{{ route('admin.fournisseurs.create') }}" class="btn btn-primary">Ajouter Un Fournisseur</a>
  	</p>
  	<table class="table table-bordered table-striped">
  		<tr>
  			<th>Raison Social</th>
  			<th>Email</th>
  			<th>Telephone</th>
  			<th>Adresse</th>
  			<th>Action</th>
  		</tr>
  		@foreach($fournisseurs as $c)
  			<tr>
  				<td>{{ $c->raisonsocial }}</td>
  				<td>{{ $c->email }}</td>
  				<td>{{ $c->telephone }}</td>
  				<td>{{ $c->adresse }}</td>
  				<td>
                    <a href="#" class="show-modal btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('admin.fournisseurs.edit',$c->id) }}" class="btn btn-warning btn-sm" data-id="{{$c->id}}"
                       data-rs="{{$c->raisonsocial }}" data-mail="{{$c->email}}"
                       data-tel="{{$c->telephone}}" data-addr="{{$c->adresse}}"
                       data-res="{{$c->responsable}}" data-br="{{$c->bureautel}}"
                       data-fax="{{$c->fax}}" data-comp="{{$c->numcomptebank}}">
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
  	</table>
  </div>
</section>
       {{--$fournisseurs->links()--}}
    {{-- Modal Form Show POST --}}
    <div id="showmodalF" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="align-content: center; color: #2a88bd;"></h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">RAISON SOCIAL :</label> <b id="rs"/>
                    </div>
                    <div class="form-group">
                        <label for="">EMAIL :</label> <b id="mail"/>
                    </div>
                    <div class="form-group">
                        <label for="">TELEPHONE :</label> <b id="tel"/>
                    </div>
                    <div class="form-group">
                        <label for="">ADRESSE :</label>  <b id="addr"/>
                    </div>
                    <div class="form-group">
                        <label for="">NOMRESPONSABLE :</label>   <b id="resp"/>
                    </div>
                    <div class="form-group">
                        <label for="">BUREAUTEL :</label> <b id="br"/>
                    </div>
                    <div class="form-group">
                        <label for="">FAX :</label>  <b id="fax"/>
                    </div>
                    <div class="form-group">
                        <label for="">NUMCOMPTEBANK :</label>   <b id="comp"/>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
    // Show function Fournisseur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');
        $('#rs').text($(this).data('rs'));
        $('#_mail').text($(this).data('mail'));
        $('#_tel').text($(this).data('tel'));
        $('#_addr').text($(this).data('addr'));
        $('#_resp').text($(this).data('res'));
        $('#_br').text($(this).data('br'));
        $('#_fax').text($(this).data('fax'));
        $('#_comp').text($(this).data('comp'));
        $('.modal-title').text('Details Fournisseur');
    });
</script>
@endsection