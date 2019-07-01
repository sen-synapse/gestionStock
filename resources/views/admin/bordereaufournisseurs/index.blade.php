@extends('layouts.admin')
@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href=" {{ route('admin.home') }}">Acceuil</a></li>
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

    <div class="card card-default">
      <div class="card-header text-center">
        <h2>LISTE DES BORDEREAUX</h2>
      </div>

      <div class="card-body">
        <table class="table table-striped">
          <tr>

            <th>Fournisseur  </th>
            <th>Date Bordereau  </th>
                <th>Nom Fichier </th>
            <th>Action</th>
          </tr>
          @if(count($bordereaufournisseurs))
            @foreach($bordereaufournisseurs as $n)
              @foreach($fournisseurs as $fournisseur)
                @if($fournisseur->id == $n->idfourniss)
                <tr>
                  <td> {{ $fournisseur->raisonsocial}}</td>
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
              @endif
            @endforeach
          @endforeach
          @else
          <tr><th colspan="3" class="text-center">Aucun Bordereau Enregistr&eacute; !</th></tr>
          @endif
        </table>
      </div>
    </div>

    {{ $bordereaufournisseurs->render() }}
  </div>
</section>


@endsection
