@extends ('layouts.app')
@section ('contenido')
  <h3>Compra Realizada!</h3>
  <a href="/Nota/{{$Factura->id_compras}}"><button class="btn btn-primary" type="button" name="button">Orden de Compra</button></a>
  <a href="/Compras/Comprar"><button class="btn btn-info" type="button" name="button">Hacer otra Compra</button></a>

@endsection
