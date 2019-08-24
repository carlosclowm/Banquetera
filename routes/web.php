<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});

Route::get('/CalendarioGet', 'CalendarioController@User')->name('rest.GetUser');
Route::get('/Calendario', 'CalendarioController@index');
Route::post('/Calendario/Agregar', 'CalendarioController@Agregar');

Route::get('/Inventario/Mobiliario', 'MobiliarioController@index');
Route::get('/Inventario/Mobiliario/Nuevo', 'MobiliarioController@Nuevo');
Route::post('/Inventario/Mobiliario/Nuevo/Agregar', 'MobiliarioController@Agregar');
Route::get('/Inventario/Cocina', 'CocinaController@index');
Route::get('/Inventario/Cocina/Nuevo', 'CocinaController@Nuevo');
Route::post('/Inventario/Cocina/Nuevo/Agregar', 'CocinaController@Agregar');
Route::get('/Inventario/Botellas', 'BotellasController@index');
Route::get('/Inventario/Botellas/Nuevo', 'BotellasController@Nuevo');
Route::post('/Inventario/Botellas/Nuevo/Agregar', 'BotellasController@Agregar');

Route::get('/Compras/Comprar', 'ComprasController@Comprar');
Route::post('/Compras/Comprar/AgregarMob', 'ComprasController@AgregarMob');
Route::post('/Compras/Comprar/AgregarCos', 'ComprasController@AgregarCos');
Route::post('/Compras/Comprar/AgregarBot', 'ComprasController@AgregarBot');
Route::delete('/Compras/Comprar/EliminarMob/{id}', 'ComprasController@EliminarMob');
Route::delete('/Compras/Comprar/EliminarCos/{id}', 'ComprasController@EliminarCos');
Route::delete('/Compras/Comprar/EliminarBot/{id}', 'ComprasController@EliminarBot');
Route::get('/Compras/Comprar/Realizar/{id}', 'ComprasController@Realizar');
Route::post('/Compras/Comprar/EditarCostoMob', 'ComprasController@EditarCostoMob');
Route::post('/Compras/Comprar/EditarCostoCos', 'ComprasController@EditarCostoCos');
Route::post('/Compras/Comprar/EditarCostoBot', 'ComprasController@EditarCostoBot');
Route::get('/Nota/{id}', 'ComprasController@NotaCompra');

Route::get('/Ventas/Vender', 'VentasController@Vender');
Route::post('/Ventas/Vender/AgregarMob', 'VentasController@AgregarMob');
Route::post('/Ventas/Vender/AgregarCos', 'VentasController@AgregarCos');
Route::post('/Ventas/Vender/AgregarBot', 'VentasController@AgregarBot');
Route::post('/Ventas/Vender/EditarCostoMob', 'VentasController@EditarCostoMob');
Route::post('/Ventas/Vender/EditarCostoCos', 'VentasController@EditarCostoCos');
Route::post('/Ventas/Vender/EditarCostoBot', 'VentasController@EditarCostoBot');
Route::delete('/Ventas/Vender/EliminarMob/{id}', 'VentasController@EliminarMob');
Route::delete('/Ventas/Vender/EliminarCos/{id}', 'VentasController@EliminarCos');
Route::delete('/Ventas/Vender/EliminarBot/{id}', 'VentasController@EliminarBot');
Route::get('/Ventas/Vender/Realizar/{id}', 'VentasController@Realizar');
Route::get('/Orden/{id}', 'VentasController@OrdenVenta');

Route::get('/Clientes', 'UsuariosController@Clientes');
Route::get('/Clientes/Nuevo', 'UsuariosController@ClientesNuevo');
Route::post('/Clientes/Nuevo/Agregar', 'UsuariosController@ClientesNuevoAgregar');
Route::get('/Proveedores', 'UsuariosController@Proveedores');
Route::get('/Proveedores/Nuevo', 'UsuariosController@ProveedoresNuevo');
Route::post('/Proveedores/Nuevo/Agregar', 'UsuariosController@ProveedoresNuevoAgregar');
Route::get('/Clientes/Editar/{id}', 'UsuariosController@ClientesEditar');
Route::post('Clientes/Edit', 'UsuariosController@ClienteEdit');
Route::get('/Proveedores/Editar/{id}', 'UsuariosController@ProveedoresEditar');
Route::post('Proveedores/Edit', 'UsuariosController@ProveedoresEdit');

Route::get('/Compras/Devolver', 'ComprasController@Devolver');
Route::post('/Compras/Devolver/Compra', 'ComprasController@DevolverCompra');
Route::get('/Nota/Devuelto/{id}', 'ComprasController@NotaDevuelto');

Route::get('/Ventas/Devolver', 'VentasController@Devolver');
Route::post('/Ventas/Devolver/Venta', 'VentasController@DevolverVenta');
Route::get('/Orden/Devolver/{id}', 'VentasController@OrdenVentaDevolver');

Route::get('/Ventas/Cotizar', 'VentasController@Cotizar');
Route::get('/Ventas/Cotizar/{id}', 'VentasController@CotizarVenta');
Route::get('/Orden/Cotizado/{id}', 'VentasController@OrdenVentaCotizar');

Route::post('/Ventas/Vender/PorCobrar', 'VentasController@PorCobrar');
Route::get('/Orden/PorCobrar/{id}', 'VentasController@OrdenCobrar');

Route::get('/Cuentas', 'CuentasController@PorCobrar');
Route::get('/Cuentas/PorCobrar/Liquidar/{id}', 'CuentasController@PorCobrarLiquidar');
Route::post('/Cuentas/PorCobrar/Abonar', 'CuentasController@Abonar');
Route::get('/Reportes', 'ReportesController@Compras');
Route::get('/Reportes/Ventas', 'ReportesController@Ventas');
Route::get('/Cuentas/PorPagar', 'CuentasController@PorPagar');

Route::post('/Compras/Comprar/PorPagar', 'ComprasController@PorPagar');
Route::get('/Nota/PorPagar/{id}', 'ComprasController@PorPagarNota');
Route::post('/Cuentas/PorPagar/Abonar', 'CuentasController@AbonarPorPagar');

Route::get('/Gastos', 'GastosController@Gastos');
Route::get('/Gastos/Motivo', 'GastosController@MotivoGastos');
Route::post('/Gastos/Motivo/Nuevo', 'GastosController@NuevoMotivo');
Route::post('/Gastos/Nuevo', 'GastosController@NuevoGasto');

Route::get('/Resumen', 'ReportesController@Resumen');
Route::post('/Resumen/Fecha', 'ReportesController@ResumenFecha');
Route::get('/Resumen/Cliente/{id}', 'ReportesController@ResumenCliente');
Route::get('/Resumen/Proveedor/{id}', 'ReportesController@ResumenProveedor');
Route::get('/Resumen/Mobiliario/{id}', 'ReportesController@ResumenMobiliario');
Route::get('/Resumen/Cocina/{id}', 'ReportesController@ResumenCocina');
Route::get('/Resumen/Botellas/{id}', 'ReportesController@ResumenBotellas');

Route::get('/Inventario/Botellas/Editar/{id}', 'BotellasController@BotellaEditar');
Route::post('Inventario/Botellas/Edit', 'BotellasController@BotellaEdit');

Route::get('/Inventario/Cocina/Editar/{id}', 'CocinaController@CocinaEditar');
Route::post('Inventario/Cocina/Edit', 'CocinaController@CocinaEdit');

Route::get('/Inventario/Mobiliario/Editar/{id}', 'MobiliarioController@MobiliarioEditar');
Route::post('Inventario/Mobiliario/Edit', 'MobiliarioController@MobiliarioEdit');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
