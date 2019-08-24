@extends ('layouts.app')
@section ('contenido')
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {
 
            (function ($) {
 
                $('#botella').keyup(function () {
 
                    var rex = new RegExp($(this).val(), 'i');
                    $('.botbus tr').hide();
                    $('.botbus tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
 
                })
 
            }(jQuery));
 
        });
</script>
<div class="nav-tabs-custom">
    <div class="nav nav-tabs pull-right">
  		<li class="pull-left header">Reportes Compras</li>
      <li><a href="/Resumen">Resumen</a></li>
  		<li><a href="/Reportes/Ventas">Ventas</a></li>
  		<li class="active"><a href="/Reportes" data-toggle="tab">Compras</a></li>
  	</div>

</div>
<div class="tab-content">
  @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
      </ul>
    </div>
    @endif
    <div class="input-group">
  <span class="input-group-addon">Buscar</span>
  <input id="botella" type="text" class="form-control" placeholder="Buscar Reportes...">
</div>
    <div class="tab-pane active">
      <div class="box-body table-responsive">
  			<div class="dataTables_wrapper form-inline" role="grid">
  				<table class="table table-bordered">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Total</th>
                <th>Proveedor</th>
                <th width="100">Opciones</th>
              </tr>
              <tbody class="botbus">
                @foreach($Compra as $cp)
                <tr>
                  <td>{{$cp->fecha}}</td>
                  <td>${{$cp->total}}</td>
                  <td>{{$cp->nombre_proveedor}}</td>
                  <td> <a href="/Nota/{{$cp->id_compras}}" class="btn btn-info">Nota</a> </td>
                </tr>
                @endforeach
              </tbody>
            </thead>
          </table>
          {{$Compra->links()}}
        </div>
      </div>
    </div>
</div>
@endsection
