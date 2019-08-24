@extends ('layouts.app')
@section ('contenido')
  <h3>Devolucion Realizada!</h3>
  <a href="/Nota/Devuelto/{{$Factura->id_compras}}"><button class="btn btn-primary" type="button" name="button">Orden Devuelto</button></a>
  <a href="/Compras/Devolver"><button class="btn btn-info" type="button" name="button">Hacer otra Devolucion</button></a>

@endsection
