@extends('layouts.admin')
@section('content')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<section class="content">
  <div class="container-fluid">

    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">ARTICLES </h3>
      </div>
      <br>
    <div class="row">
      <div class="col-md-4 col-sm-3">
      <a href="#" 
            class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU ARTICLE</a>
      </div>

      <div class="col-md-7 col-sm-6">
          <form  action="{{ route('admin.articles.recherche') }}" method="get">
           <input type="text" name="recherche" class="form-control" placeholder="Recherche tout fournisseur"
            style="border-top: none;border-left: none;border-right: none;">
          <br>
          <input type="submit" class="btn btn-danger" style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff; float: right;" value="Rechercher">
        </form>
      </div>
    </div> 
    <br>

      <div class="card-body">
        <table class="table table-striped">
          <tr>
            <th>Code</th>
            <th>Sous categorie</th>
            <th>Article</th>
            <th>Unité</th>
            <th>Dimension</th>
            <th>Action</th>
          </tr>
          @if($articles->count() > 0)

            @foreach($articles as $at)
              <tr>
                <td>{{ $at->codearticle }}</td>

                @foreach($souscategories as $sc)
                  @if($at->idsoucat == $sc->id)
                    <td>{{ $sc->souscategorie }}</td>
                  @endif
                @endforeach
                <td>{{ $at->article}}</td>
                <td>{{ $at->unitearticle}}</td>
                <td>{{ $at->dimension}}</td>
                <td>
                  <a href="#" class="show-modal btn btn-info btn-sm"  style="box-shadow: 0px 0px 15px #95A5A6; background: #1DC7EA; color: #fff;" data-id="{{$sc->id}}"
                     data-code="{{$at->codearticle}}" data-sc="{{$sc->souscategorie}}"
                     data-article="{{ $at->article }}" data-unite="{{ $at->unitearticle}}"
                     data-dimension="{{$at->dimension}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ route('admin.articles.edit', $at->id) }}" class="btn btn-warning btn-sm" data-id="{{$sc->id}}"
                  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF9500; color: #fff;">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-sm"
                  style="box-shadow: 0px 0px 15px #95A5A6; background: #FF4A55; color: #fff;">
                      <i class="fa fa-trash"></i>
                  </a>
                 <form action="{{ route('admin.articles.destroy',$at->id) }}" method="post">
                  @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <th colspan="6" class="text-center"> Aucun article !</th>
            </tr>
          @endif

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
              <button type="button" class="close" data-dismiss="modal" style="font-size: 30px; color: #fff;">&times;</button>
              <h4 class="modal-title text-center" style=" color: #fff;"></h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">IDENTIFIANT :</label>
                    <input type="val" class="form-control" id="id" disabled>
                </div>
                <div class="form-group">
                    <label for="">CODE :</label>
                    <input type="val" class="form-control" id="code" disabled>
                </div>
                <div class="form-group">
                    <label for="">SOUS CATEGORIE :</label>
                    <input type="val" class="form-control" id="sc" disabled>
                </div>
                <div class="form-group">
                    <label for="">ARTICLE :</label>
                    <input type="val" class="form-control" id="article" disabled>
                </div>
                <div class="form-group">
                    <label for="">UNITE :</label>
                    <input type="val" class="form-control" id="unite" disabled>
                </div>
                <div class="form-group">
                    <label for="">DIMENSION :</label>
                    <input type="val" class="form-control" id="dimension" disabled>
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
                  <form method="post" action="{{ route('admin.articles.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">

                      <div class="row">
                        <label class="col-md-3">Sous categorie : </label>
                        <div class="col-md-6">
                          <select class="form-control" name="idsoucat">
                            @foreach($souscategories as $sc)
                              <option value="{{$sc->id}}">{{ $sc->souscategorie }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Code : </label>
                        <div class="col-md-6"><input type="text" name="codearticle" class="form-control {{ $errors->has('codearticle') ? 'is-invalid' : ''}}" value="{{ old('codearticle')}}">
                          @if($errors->has('codearticle'))
                            <div class="text-center text-danger">
                              {{ $errors->first('codearticle')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </div>



                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Article : </label>
                        <div class="col-md-6"><input type="text" name="article" class="form-control {{ $errors->has('article') ? 'is-invalid' : ''}}" value="{{ old('article')}}">
                          @if($errors->has('article'))
                            <div class="text-center text-danger">
                              {{ $errors->first('article')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </div>


                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Unite : </label>
                        <div class="col-md-6"><input type="text" name="unitearticle" class="form-control {{ $errors->has('unitearticle') ? 'is-invalid' : ''}}" value="{{ old('unitearticle')}}">
                          @if($errors->has('unitearticle'))
                            <div class="text-center text-danger">
                              {{ $errors->first('unitearticle')}}
                            </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="row">
                        <label class="col-md-3">Dimension : </label>
                        <div class="col-md-6"><input type="text" name="dimension" class="form-control {{ $errors->has('dimension') ? 'is-invalid' : ''}}" value="{{ old('dimension')}}">
                          @if($errors->has('dimension'))
                            <div class="text-center text-danger">
                              {{ $errors->first('dimension')}}
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
    $('#id').val($(this).data('id'));
    $('#code').val($(this).data('code'));
    $('#sc').val($(this).data('sc'));
    $('#article').val($(this).data('article'));
    $('#unite').val($(this).data('unite'));
    $('#dimension').val($(this).data('dimension'));
    $('.modal-title').text('Details Article');
    $('.modal-header').css('background', '#1DC7EA');
}); 

$(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter Article');
        $('.modal-header').css('background', '#1D62F0');
    }); 
</script>
@endsection
