@extends('layouts.admin')

@section('content')
<section class="content">
<br>
    <div class="row">
        <div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1">
            <div class="card-default">
                <div class="card-body" style="background: linear-gradient(150deg, #3498db, #8E44AD); border-radius: 5px; box-shadow: 0px 0px 15px #BDC3C7;">
                    <div class="" style="font-size: 20px; padding: 30px; color:  rgb(215, 218, 219, 0.8);">
                        {{App\Models\Article::count() }} Article(s)  
                        <i class="pe-7s-ribbon" style="font-size: 80px;"></i>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-3 col-sm-3 ">
            <div class="card-default">
                <div class="card-body" style="background: linear-gradient(150deg, #F39C12, #9B59B6); border-radius: 5px; box-shadow: 0px 0px 15px #BDC3C7;">
                    <div class="" style="font-size: 20px; padding: 30px; color:  rgb(215, 218, 219, 0.8);">
                        {{App\Models\Client::count() }} Client(s)
                        <i class="pe-7s-user" style="font-size: 80px;"></i>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-3 col-sm-3 ">
            <div class="card-default">
                <div class="card-body" style="background: linear-gradient(150deg, #1ABC9C, #3498db); border-radius: 5px; box-shadow: 0px 0px 15px #BDC3C7;">
                    <div class="" style="font-size: 20px; padding: 30px; color:  rgb(215, 218, 219, 0.8);">
                        {{App\Models\LigneVente::count() }} Vente(s)
                        <i class="pe-7s-cart" style="font-size: 80px;"></i>
                    </div>
                </div>
            </div>
        </div> 

    </div> 
    <br> 
    <br>
    <div class="row ">
        <div class="col-md-11" style="margin-left: 2%;">
            <div class="card"> 
            <div class="car-header">
            <p class="text-center" style="padding: 20px; background: #3498db; color:#fff; font-size: 20px;"> DERNIERES OPERATIONS EFFECTUEES</p>
               
            </div>
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Login</th>
                        <th>Operation</th> 
                        <th>Libelle</th>
                    </thead> 
                    <tbody> 
                       @foreach(App\Models\Historique::all() as $h)
                            <tr>
                                <td>{{ $h->user}}</td>
                                <td>{{ $h->operation }}</td>
                                <td>{{ $h->libelle }}</td>
                            </tr>
                       @endforeach
                    </tbody> 
                </table>
                </div> 
            </div>
        </div>
    </div>
   
</section>
@endsection
