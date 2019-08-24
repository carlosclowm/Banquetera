@extends ('layouts.app')
@section ('contenido')
  <h3>Venta Realizada!</h3>
  <a href="/Orden/{{$Factura->id_ventas}}"><button class="btn btn-primary" type="button" name="button">Orden de Venta</button></a>
  <a href="/Ventas/Vender"><button class="btn btn-info" type="button" name="button">Hacer otra Venta</button></a>

@endsection
