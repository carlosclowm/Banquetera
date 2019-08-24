@extends ('layouts.app')
@section ('contenido')
  <h3>Venta Realizada! Ahora debe: $<?=number_format($Debe);  ?></h3>
  <a href="/Orden/PorCobrar/{{$Factura->id_ventas}}"><button class="btn btn-primary" type="button" name="button">Orden de Venta</button></a>
  <a href="/Ventas/Vender"><button class="btn btn-info" type="button" name="button">Hacer otra Venta</button></a>

@endsection
