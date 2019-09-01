<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    {{Auth::user()->email}}
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{ route('admin.home') }}">
                        <i class="pe-7s-graph"></i>
                        <p>ACCUEIL</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.fournisseurs.index') }}">
                        <i class="pe-7s-user"></i>
                        <p>FOURNISSEURS</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bordereaufournisseurs.index') }}">
                        <i class="pe-7s-news-paper"></i>
                        <p>BORDEREAU FOURNISSEURS</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.articles.index')}}">
                        <i class="pe-7s-science"></i>
                        <p>NOUVEAU ARTICLE</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.articlerecus.index')}}">
                        <i class="pe-7s-map-marker"></i>
                        <p>ARTICLES RECUS</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-bell"></i>
                        <p>GAMMES</p>
                    </a>
                </li>
				<li>
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="pe-7s-rocket"></i>
                        <p>CATEGORIES</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.souscategories.index') }}">
                        <i class="pe-7s-rocket"></i>
                        <p>SOUS CATEGORIES</p>
                    </a>
                </li>
                @if(Auth::user()->niveau == 2)
                <li>
                    <a href="{{ route('admin.utilisateurs.index') }}">
                        <i class="pe-7s-rocket"></i>
                        <p>UTILISATEURS</p>
                    </a>
                </li> 
                @endif
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-lg hidden-md"></b>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="{{ route('admin.profil.index') }}">
                               <p>Mon profil</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Dropdown
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="pe-7s-power text-danger"></i>
                                        {{ __('Se deconnecter ') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>
        
          @yield('content')

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{asset('js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('js/bootstrap-notify.js')}}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{asset('js/demo.js')}}"></script>

    
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <script type="text/javascript"> 
         @if(Session::has('success'))
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-angle-down-circle',
                    message: "{{Session::get('success')}}"

                },{
                    type: 'success',
                    timer: 4000
                });

            }); 
        @endif 

        @if(Session::has('info'))
            $(document).ready(function(){

                demo.initChartist();

                $.notify({
                    icon: 'pe-7s-info',
                    message: "{{Session::get('info')}}"

                },{
                    type: 'info',
                    timer: 4000
                });

            }); 
        @endif

	</script>
</html>
