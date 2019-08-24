@extends('layouts.app')
@section('contenido')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      var DatosG = {!! json_encode($Grafica) !!};
      console.log(DatosG);
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(DatosG);
        var options = {
          title: 'Graficas',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Grafica</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="height: 260px;">
          <div class="panel panel-default">
        <div class="col-sm-8 col-md-8 col-lg-12">
          <h3 id="curve_chart"></h3>
        </div>
        </div>
        </div>
    </div>

@endsection
