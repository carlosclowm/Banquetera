<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Toriba | Sistema</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="../css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="../css/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
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
                    });
                    console.log(test);
                    
                    $("#refrMenu").html(dhtml);
                    //console.log(data);
                    
                },error:function(){ 
                     console.log(data);
                }
            });
            }
              
        </script>
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


                    <div class="row">
                        <div class="col-md-3">
                            
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Crear Evento</h3>
                                </div>
                                @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
                                <div class="box-body" align="center">
                                {!!Form::open(array('url'=>'/Calendario/Agregar','method'=>'POST','autocomplete'=>'off',))!!}
                                {{Form::token()}}
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        
                                        <select name="Prioridad" class="btn btn-github btn-block btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret"></span>
                                            <option class="text-green" value="success">Normal</option>
                                            <option class="text-yellow" value="warning">Intermedio</option>
                                            <option class="text-red" value="danger">Urgente</option>
                                        </select>
                                    </div>
                                    <!-- /btn-group -->
                                    
                                    <div class="input-group">
                                        <input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                        <input type="time" name="hora" value="<?php echo date('H:i:s'); ?>" class="form-control">
                                    </div>
                                    <div class="input-group"> 
                                        <input id="new-event" type="text" class="form-control" placeholder="Titulo del Evento" name="titulo">
                                    </div>
                                    <div class="input-group"> 
                                        <textarea name="nota" placeholder="Nota Para el Evento" class="form-control" rows="6" cols="17"></textarea>
                                    </div>
                                    <div class="input-group"> 
                                        <input id="new-event" type="text" class="form-control" placeholder="Correo a Asignar Evento" name="correo">
                                    </div>
                                    <div class="input-group" align="center"> 
                                        <button class="btn btn-success form-control" type="submit">Agregar</button>

                                    </div>
                                {!!Form::close()!!}
                                </div>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-md-9">
                            <div class="box box-primary">                                
                                <div class="box-body no-padding">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div><!-- /.box-body -->
                            </div><!-- /. box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->  


                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="../js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- Page specific script -->
        <script type="text/javascript">
            $(function() {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function ini_events(ele) {
                    ele.each(function() {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0  //  original position after the drag
                        });

                    });
                }
                ini_events($('#external-events div.external-event'));

                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)
                const tsk = {!! $Tareas !!};
                var date = new Date();
                var d = date.getDate(),
                        m = date.getMonth(),
                        y = date.getFullYear();
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {//This is to add icons to the visible buttons
                        prev: "<span class='fa fa-caret-left'></span>",
                        next: "<span class='fa fa-caret-right'></span>",
                        today: 'Hoy',
                        month: 'Mes',
                        week: 'Semana',
                        day: 'Dia'
                    },
                    //Random default events
                    events: tsk,
                    editable: true,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    }
                });

                /* ADDING EVENTS */
                var currColor = "#f56954"; //Red by default
                //Color chooser button
                var colorChooser = $("#color-chooser-btn");
                $("#color-chooser > li > a").click(function(e) {
                    e.preventDefault();
                    //Save color
                    currColor = $(this).css("color");
                    //Add color effect to button
                    colorChooser
                            .css({"background-color": currColor, "border-color": currColor})
                            .html($(this).text()+' <span class="caret"></span>');
                });
                $("#add-new-event").click(function(e) {
                    e.preventDefault();
                    //Get value and make sure it is not null
                    var val = $("#new-event").val();
                    if (val.length == 0) {
                        return;
                    }

                    //Create event
                    var event = $("<div />");
                    event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
                    event.html(val);
                    $('#external-events').prepend(event);

                    //Add draggable funtionality
                    ini_events(event);

                    //Remove event from text input
                    $("#new-event").val("");
                });
            });
        </script>

    </body>
</html>