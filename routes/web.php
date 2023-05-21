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
Route::group(['prefix' => 'upload'], function(){
    Route::get('/', 'Gfsiniestros\Upload@index');
    Route::post('/dropzone/{folder}', 'Gfsiniestros\Upload@dropzone');
});

Route::group(['prefix' => 'beneficiarios'], function(){
    Route::get('/', 'Gfsiniestros\Beneficiarios@index');
    Route::post('/listado_beneficiarios/{id_solicitud}', 'Gfsiniestros\Beneficiarios@listado_beneficiarios');
    Route::get('/list/{id_solicitud}', 'Gfsiniestros\Beneficiarios@list');
    Route::get('/datos/{id_beneficiario}', 'Gfsiniestros\Beneficiarios@datos');
    Route::get('/upload/{id_beneficiario}', 'Gfsiniestros\Beneficiarios@upload');
    Route::post('/update_poliza_designacion/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_poliza_designacion');
    Route::post('/update_comprobante_domicilio/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_comprobante_domicilio');
    Route::post('/update_comprobante_domicilio_extranjero/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_comprobante_domicilio_extranjero');
    Route::post('/update_ine/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_ine');
    Route::post('/update_fto_pld/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_fto_pld');
    Route::post('/update_fto_transferencia/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_fto_transferencia');
    Route::post('/update_estado_cuenta/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_estado_cuenta');
    Route::post('/update_cedula_fiscal/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_cedula_fiscal');
    Route::post('/update_curp/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_curp');
    Route::post('/update_comprobante_fiel/{id_beneficiario}/{file}', 'Gfsiniestros\Beneficiarios@update_comprobante_fiel');
    Route::get('/form_data/{id_beneficiario}/{id_solicitud}', 'Gfsiniestros\Beneficiarios@form_data');
});

Route::group(['prefix' => 'solicitudes'], function(){
    Route::get('/', 'Gfsiniestros\Solicitudes@index');
    Route::post('/listado_solicitudes', 'Gfsiniestros\Solicitudes@listado_solicitudes');
    Route::get('/modal_add_solicitud', 'Gfsiniestros\Solicitudes@modal_add_solicitud');
    Route::get('/modal_edit_solicitud/{id_solicitud}', 'Gfsiniestros\Solicitudes@modal_edit_solicitud');
    Route::post('/buscar', 'Gfsiniestros\Solicitudes@buscar');
    Route::post('/insertar', 'Gfsiniestros\Solicitudes@insertar');
    Route::get('/listado', 'Gfsiniestros\Solicitudes@listado');
    Route::post('/nuevo_registro', 'Gfsiniestros\Solicitudes@nuevo_registro');
    Route::get('/upload/{id_solicitud}', 'Gfsiniestros\Solicitudes@upload');
    Route::post('/update_ine/{id_solicitud}/{file}', 'Gfsiniestros\Solicitudes@update_ine');
    Route::post('/update_act_nac/{id_solicitud}/{file}', 'Gfsiniestros\Solicitudes@update_act_nac');
    Route::post('/update_act_def/{id_solicitud}/{file}', 'Gfsiniestros\Solicitudes@update_act_def');
    Route::post('/update_fto_rec/{id_solicitud}/{file}', 'Gfsiniestros\Solicitudes@update_fto_rec');
    Route::get('/form_data/{id_solicitud}', 'Gfsiniestros\Solicitudes@form_data');
});

Route::group(['prefix' => 'pdf'], function(){
    Route::get('/{id_evaluacion}', 'Forap\Pdf@index');
});

Route::group(['prefix' => 'direcciones'], function(){
    Route::get('/modal_dir/{iden}/{id}/{hidden}', 'Framework\Direcciones@modal_dir');
    Route::post('/cp_search/{cp}', 'Framework\Direcciones@cp_search');
    Route::post('/get_all/{id_cp}', 'Framework\Direcciones@get_all');
    Route::post('/insert', 'Framework\Direcciones@insert');
    Route::post('/get_ciudades/{estado}/{pais}', 'Framework\Direcciones@get_ciudades');
    Route::post('/get_estados/{pais}', 'Framework\Direcciones@get_estados');
});

Route::group(['prefix' => 'webhook'], function(){
        Route::get('/', 'Framework\Webhook@index');
        Route::any('/backup', 'Framework\Webhook@backup');
        Route::any('/populate', 'Framework\Webhook@populate');
        Route::any('/syncuser', 'Framework\Webhook@syncuser');
        Route::any('/updateuser', 'Framework\Webhook@updateuser');
        Route::any('/updateroldata', 'Framework\Webhook@updateroldata');
        Route::any('/syncrol', 'Framework\Webhook@syncrol');
        Route::any('/syncmetodo', 'Framework\Webhook@syncmetodo');
});
Route::group(['prefix' => 'systemroles'], function(){
        Route::get('/', 'Framework\Systemroles@index');
        Route::get('/modal_roles/{id_sistema}', 'Framework\Systemroles@modal_roles');
        Route::post('/agregar_rol/{id_sistema}', 'Framework\Systemroles@agregar_rol');
        Route::get('/permisos/{id_rol}/{id_sistema}', 'Framework\Systemroles@permisos');
});
Route::group(['prefix' => 'permisos'], function(){
        Route::get('/', 'Framework\Permisos@index');
        Route::get('/main/{id_sistema}', 'Framework\Permisos@main');
        Route::post('/obtener_controllers/{id_sistema}', 'Framework\Permisos@obtener_controllers');
        Route::get('/modal_add_metodo/{id_sistema}', 'Framework\Permisos@modal_add_metodo');
        Route::post('/agregar_metodo', 'Framework\Permisos@agregar_metodo');
        Route::any('/data_controller/{id}', 'Framework\Permisos@data_controller');
        Route::any('/editar_metodo', 'Framework\Permisos@editar_metodo');
        Route::any('/eliminar_par/{id}', 'Framework\Permisos@eliminar_par');
});
Route::group(['prefix' => 'systemusers'], function(){
        Route::get('/', 'Framework\Systemusers@index');
        Route::get('/listado/{id_sistema}', 'Framework\Systemusers@listado');
        Route::post('/obtener_usuarios/{id_sistema}', 'Framework\Systemusers@obtener_usuarios');
        Route::get('/loginlogger/{id_sistema}', 'Framework\Systemusers@loginlogger');
        Route::post('/loginlogger_get/{id_sistema}', 'Framework\Systemusers@loginlogger_get');
        Route::get('/logueados/{id_sistema}', 'Framework\Systemusers@logueados');
        Route::post('/logueados_get/{id_sistema}', 'Framework\Systemusers@logueados_get');
});
Route::group(['prefix' => 'catalogo'], function(){
        Route::get('/', 'Framework\Catalogo@index');
        Route::post('/obtener_catalogo', 'Framework\Catalogo@obtener_catalogo');
        Route::any('/editar_catalogo', 'Framework\Catalogo@editar_catalogo');
        Route::get('/eliminar_elemento/{ID}', 'Framework\Catalogo@eliminar_elemento');
        Route::get('/modal_add_elemento', 'Framework\Catalogo@modal_add_elemento');
        Route::post('/agregar_elemento', 'Framework\Catalogo@agregar_elemento');
        Route::any('/getCatalogoSecundario/{id_padre}/{nombre_cat}/{other?}', 'Framework\Catalogo@getCatalogoSecundario');
        Route::get('/data_catalogo/{id}', 'Framework\Catalogo@data_catalogo');
});
Route::group(['prefix' => 'roles'], function(){
        Route::any('/', 'Framework\Roles@index');
        Route::any('/index', 'Framework\Roles@index');
        Route::get('/establecer_permiso/{role}/{metodo}/{estado}', 'Framework\Roles@establecer_permiso');
        Route::any('/establecer_acceso/{id_rol}/{access}/{estado}', 'Framework\Roles@establecer_acceso');
        Route::any('/clonar/{id_rol}/{transfer}', 'Framework\Roles@clonar');
        Route::post('/agregar_rol', 'Framework\Roles@agregar_rol');
        Route::get('/modal_roles', 'Framework\Roles@modal_roles');
        Route::get('/permisos/{rol}', 'Framework\Roles@permisos');
});
Route::group(['prefix' => 'controllers'], function(){
        Route::get('/', 'Framework\Controllers@index');
        Route::post('/obtener_controllers', 'Framework\Controllers@obtener_controllers');
        Route::get('/data_controller/{id}', 'Framework\Controllers@data_controller');
        Route::post('/editar_metodo', 'Framework\Controllers@editar_metodo');
        Route::get('/modal_add_metodo', 'Framework\Controllers@modal_add_metodo');
        Route::post('/agregar_metodo', 'Framework\Controllers@agregar_metodo');
        Route::get('/eliminar_par/{id}', 'Framework\Controllers@eliminar_par');
});
Route::group(['prefix' => 'usuarios'], function(){
        Route::get('/', 'Framework\Usuarios@index');
        Route::post('/upload_dropzone/{ruta}/{permisos}', 'Framework\Usuarios@upload_dropzone');
        Route::post('/update_avatar/{file}', 'Framework\Usuarios@update_avatar');
        Route::post('/editar_perfil', 'Framework\Usuarios@editar_perfil');
        Route::get('/perfil', 'Framework\Usuarios@perfil');
        Route::post('/obtener_usuarios', 'Framework\Usuarios@obtener_usuarios');
        Route::get('/modal_add_usr', 'Framework\Usuarios@modal_add_usr');
        Route::post('/agregar_usuario', 'Framework\Usuarios@agregar_usuario');
        Route::get('/datos_usuario/{id_usuario}', 'Framework\Usuarios@datos_usuario');
        Route::get('/desbloquea_usuario/{id_usuario}', 'Framework\Usuarios@desbloquea_usuario');
        Route::get('/desbloquear_usuarios', 'Framework\Usuarios@desbloquear_usuarios');
        Route::post('/editar_usuario', 'Framework\Usuarios@editar_usuario');
        Route::get('/logueados', 'Framework\Usuarios@logueados');
        Route::post('/logueados_get', 'Framework\Usuarios@logueados_get');
        Route::post('/cambiar_password', 'Framework\Usuarios@cambiar_password');
        Route::get('/tyc/{stat}', 'Framework\Usuarios@tyc');
});
Route::group(['prefix' => 'inicio'], function(){
        Route::get('/', 'Framework\Inicio@index');
        Route::get('/load_start', 'Framework\Inicio@load_start');
});
Route::group(['prefix' => 'login'], function(){
        Route::get('/', 'Framework\Login@index');
        Route::post('/logear', 'Framework\Login@logear');
        Route::any('/recuperar_datos', 'Framework\Login@recuperar_datos');
        Route::get('/403', 'Framework\Login@error403');
        Route::get('/error404', 'Framework\Login@error404');
        Route::get('/error500', 'Framework\Login@error500');
        Route::get('/tyc', 'Framework\Login@tyc');
        Route::get('/pass_chge', 'Framework\Login@pass_chge');
        Route::get('/lockSession', 'Framework\Login@lockSession');
        Route::post('/salir', 'Framework\Login@salir');
        Route::post('/verifica_session', 'Framework\Login@verifica_session');
        Route::get('/keepAliveReset', 'Framework\Login@keepAliveReset');
        Route::get('/keepAlive', 'Framework\Login@keepAlive');
        Route::get('/modal_sign_out/{id_usuario}', 'Framework\Login@modal_sign_out');
        Route::get('/sign_out/{id_usuario}', 'Framework\Login@sign_out');
        Route::get('/loginlogger', 'Framework\Login@loginlogger');
        Route::post('/loginlogger_get', 'Framework\Login@loginlogger_get');
        Route::get('/modal_all_sign_out', 'Framework\Login@modal_all_sign_out');
        Route::get('/sign_all_out', 'Framework\Login@sign_all_out');
        Route::get('/auditoria', 'Framework\Login@auditoria');
        Route::post('/auditoria_get', 'Framework\Login@auditoria_get');
        Route::get('/modal_auditoria/{id_usuario}', 'Framework\Login@modal_auditoria');
        Route::post('/getAuditoriaUserDate/{id_usuario}/{date}', 'Framework\Login@getAuditoriaUserDate');
});
Route::get('/', 'Framework\Site@index');
Route::group(['prefix' => 'site'], function(){
        Route::get('/', 'Framework\Site@index');
});
Route::any('401', function(){
    return view('plantilla/401');
});
Route::fallback('Framework\Login@error404');
