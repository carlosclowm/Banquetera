@extends ('layouts.app')
@section ('contenido')
  <h3>Cotizacion Realizada!</h3>
  <a href="/Orden/Cotizado/{{$Factura->id_ventas}}"><button class="btn btn-primary" type="button" name="button">Orden de Cotizacion</button></a>
  <a href="/Ventas/Cotizar"><button class="btn btn-info" type="button" name="button">Hacer otra Cotizacion</button></a>

@endsection
