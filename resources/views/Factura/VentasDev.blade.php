@extends ('layouts.app')
@section ('contenido')
  <h3>Devolucion Realizada!</h3>
  <a href="/Orden/Devolver/{{$Factura->id_ventas}}"><button class="btn btn-primary" type="button" name="button">Orden de Devolucion</button></a>
  <a href="/Ventas/Devolver"><button class="btn btn-info" type="button" name="button">Hacer otra Devolucion</button></a>

@endsection
