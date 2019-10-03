@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/jquery.3.2.1.min.js') }}"></script>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">

      <div class="card-header val-center">
        <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">HISTORIQUES</h3>
      </div>
      <div class="row">
        <div class="col-md-7 col-sm-6" style="margin-left: 5%;">
          <input id="myInput" type="search" placeholder="Recherche historique " class="form-control filtre" align="center"
          style="border-top: none;border-left: none;border-right: none;"> 
        </div>
      </div>
       <br> 
      <div class="card-body">
        <table class="table table-striped">
      		<thead>
      			<th>Utilisateur</th>
      			<th>OPERATION</th>
      			<th>LIBELLE</th>
            <th>Date</th>
      		</thead>
          <tbody id="tbody">
        
          @foreach($historiques as $h)
            @foreach(App\User::all() as $u)
              @if($u->id == $h->user)
                <tr>
                  <td>{{ $u->email }}</td>
                  <td>{{ $h->operation }}</td>
                  <td>{{ $h->libelle }}</td>
                  <td>{{ $h->created_at }}</td>
                </tr> 
              @endif 
            @endforeach
          @endforeach
          </tbody> 

          
      	</table>
      </div> 
    </div>
    <div class="card-footer text-center">
        <tr>
            <td colspan="3" class="text-center"> {{ $historiques->links() }} </td>
        </tr>
      </div>
  </div> 
</section> 

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
        });
    });
</script>

@endsection
