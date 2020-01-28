@extends('layouts.admin')
@section('content')

    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">

      <div class="card-header val-center">
        <h3 class="text-center" style="background: #2196f3; color: #fff; padding: 20px;">HISTORIQUES</h3>
      </div>

       <br>
      <div class="card-body">
        <table class="table table-striped" id="datatable">
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
    $('#datatable').dataTable();
</script>

@endsection
