<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Toriba | Sistema</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset('css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            function Recargar() {
                $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '{{route("rest.GetUser")}}',
                dataType: 'json',
                success: function (data) {
                    
                    var dhtml="";
                    data.forEach(function(element) {
                      dhtml += '<li>'+'<a href="#"><div class="pull-left"><img src="../img/avatar2.png" class="img-circle" alt="user image"/></div>'+'<h4>'+element['titulo']+' <small><i class="fa fa-clock-o"></i>         {{cl->hace}}</small></h4><p>'+element['nota']+'</p>'+'</a>'+'</li>';
                      console.log(element['hace']);
                    });

                    
                    $("#refrMenu").html(dhtml);
                    //console.log(data);
                    
                },error:function(){ 
                     console.log(data);
                }
            });
            }
              
        </script>
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black" onload="setInterval('Recargar()',3000);">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/home" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="{{asset('logo.svg')}}" width="140">
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-calendar-o"></i>
                                @if(count($Calendario)>0)
                                <span class="label label-success">{{count($Calendario)}}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Tareas Asignadas</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" name="refrMenu" id="refrMenu">
                                        @foreach ($Calendario as $cl)
                                        <li><!-- start message -->
                                            <a href="#">
                                                <h4>
                                                    {{$cl->titulo}}
                                                    <small><i class="fa fa-clock-o"></i>
                                                        {{cl->hace}}
                                                    </small>
                                                </h4>
                                                <p>
                                                    
                                                        {{$cl->nota}}
                                                    
                                                </p>
                                            </a>
                                        </li><!-- end message -->
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="footer"><a href="/Calendario">Ver Calendario</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->

                        <!-- Tasks: style can be found in dropdown.less -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ auth()->user()->name }}<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->

                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{asset('/img/avatar3.png')}}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hola, {{ auth()->user()->name }}</p>

                        </div>
                    </div>
                    <!-- search form -->

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li>
                            <a href="/Inventario/Mobiliario">
                                 <span>Mobiliario</span>
                            </a>
                        </li>
                        <li>
                        	<a href="/Inventario/Cocina">
                        		<span>Cocina</span>
                        	</a>
                        </li>
                        <li>
                        	<a href="/Inventario/Botellas">
                        		<span>Vinos y Licores</span>
                        	</a>
                        </li>
                    </ul>
                    <ul class="sidebar-menu">
                        <li>
                        	<a href="/Compras/Comprar">
                        		<span>Compras / Devoluciones</span>
                        	</a>
                        </li>
                        <li>
                        	<a href="/Ventas/Vender">
                        		<span>Ventas / Devoluciones / Cotizar</span>
                        	</a>
                        </li>
                        </ul>
                        <ul class="sidebar-menu">
                        <li>
                        	<a href="/Cuentas">
                        		<span>Cuentas</span>
                        	</a>
                        </li>
                        <li>
                        	<a href="/Reportes">
                        		<span>Reportes</span>
                        	</a>
                        </li>
                    </ul>
                    <ul class="sidebar-menu">
                        <li>
                        	<a href="/Gastos">
                        		<span>Gastos</span>
                        	</a>
                        </li>
                        <li>
                        	<a href="/Clientes">
                        		<span>Clientes</span>
                        	</a>
                        </li>
                        <li>
                        	<a href="/Proveedores">
                        		<span>Proveedores</span>
                        	</a>
                        </li>


                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->


                <!-- Main content -->
                <section class="content">
                	@yield('contenido')

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{asset('/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('/js/AdminLTE/app.js')}}" type="text/javascript"></script>

    </body>
</html>
