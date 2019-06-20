@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6" style="text-align: right; font-style: italic;">
            <h1 class="m-0 text-dark"><b>Bordereaux Fournisseurs</b></h1>
        </div><!-- /.col -->

      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">B F </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
  	<p>
  		<a href="{{ route('admin.bordereaufournisseurs.create') }}" class="btn btn-primary">Nouveau Bordereau</a>
  	</p>
  	<table class="table table-bordered table-striped">
  		<tr>

  			<th>Fournisseur  </th>
  			<th>Date Bordereau  </th>
            <th>Nom Fichier </th>
  			<th>Action</th>
  		</tr>
      @if(count($bordereaufournisseurs))
  		@foreach($bordereaufournisseurs as $n)
  			<tr>
  				<td></td>
  				<td>{{ $n->datebrd }}</td>
  				<td><a href="#">{{ $n->fichier }}</a></td>

  				<td>
                    <a href="#" class="show-modal btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="btn btn-warning btn-sm" data-id="{{$n->id}}">
                        <i class="fa fa-pencil"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
             <form action="#" method="post">
              @method('DELETE')
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </td>
  			</tr>
  		@endforeach
      @else
      <tr><td colspan="3">Aucun Bordereau Enregistr&eacute;</td></tr>
      @endif
  	</table>
    {{ $bordereaufournisseurs->render() }}
  </div>
</section>	


@endsection