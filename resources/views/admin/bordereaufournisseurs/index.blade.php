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
  		<a href="{{ route('admin.bordereaufournisseurs.create') }}" class="btn btn-primary">NOUVEAU BORDEREAU</a>
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
                  <td>{{ $n->fichier }}</td>

                  <td>
                        <a href="{{ route('admin.articlerecus.ajouter', ['id' => $n->id] )}}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="#" class="show-modal btn btn-info btn-sm"
                            data-fichier="{{$n->fichier}}">
                            <i class="fa fa-eye"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="#" class="btn btn-warning btn-sm" data-id="{{$n->id}}">
                            <i class="fa fa-pencil"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </a>
                     <form action="{{ route('admin.bordereaufournisseurs.destroy',$n->id) }}" method="post">
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
    <div id="showmodalF" class="modal fade" role="dialog">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 150%;">
                <div class="modal-header">
                    <h4 class="modal-title" style="align-content: center; color: #2a88bd;"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style=" height: 80vh;">

                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{ asset('js/pdfobject.min.js') }}"> </script>

<script>

    // Show function Fournisseur
    $(document).on('click', '.show-modal', function() {
        $('#showmodalF').modal('show');

        var fichier = '{{ asset('uploads/bordereaufournisseurs/')}} ' + '/' + $(this).data('fichier');

        PDFObject.embed(fichier, '.modal-body');
        $('.modal-title').text('Bordereau Fournisseur');
    });
</script>
@endsection
