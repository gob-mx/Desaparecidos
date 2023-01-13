<?php

use Illuminate\Database\Seeder;

class populateCatalogo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>1,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_ubicacion',
      'etiqueta'=>'Oficinas Centrales',
      'activo'=>'1',
      'orden'=>0,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2017-11-15 18:25:59'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>2,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_ubicacion',
      'etiqueta'=>'Base',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>3,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Activo',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>4,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Inactivo',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>5,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Eliminado',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>6,
      'id_padre'=>NULL,
      'catalogo'=>'tiporol',
      'etiqueta'=>'Framework',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>7,
      'id_padre'=>NULL,
      'catalogo'=>'tiporol',
      'etiqueta'=>'Cliente',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>8,
      'id_padre'=>NULL,
      'catalogo'=>'tiporol',
      'etiqueta'=>'Operacion',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:14'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>9,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Login Fallido',
      'activo'=>'1',
      'orden'=>4,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>10,
      'id_padre'=>NULL,
      'catalogo'=>'pass_chge',
      'etiqueta'=>'Requerir cambio de password',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:52:04'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>11,
      'id_padre'=>NULL,
      'catalogo'=>'pass_chge',
      'etiqueta'=>'No requerir cambio de password',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:52:40'
      ));



      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>12,
      'id_padre'=>NULL,
      'catalogo'=>'access_name',
      'etiqueta'=>'Acceso a Roles',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>NULL,
      'user_alta'=>1,
      'user_mod'=>NULL,
      'fecha_alta'=>'2019-01-03 12:16:22',
      'fecha_mod'=>NULL
      ));


      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>13,
      'id_padre'=>NULL,
      'catalogo'=>'status',
      'etiqueta'=>'Unsync',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>19,
      'id_padre'=>NULL,
      'catalogo'=>'auditable',
      'etiqueta'=>'Auditar',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>20,
      'id_padre'=>NULL,
      'catalogo'=>'auditable',
      'etiqueta'=>'No auditar',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>21,
      'id_padre'=>NULL,
      'catalogo'=>'status_remoteUser',
      'etiqueta'=>'Vigente',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>22,
      'id_padre'=>NULL,
      'catalogo'=>'status_remoteUser',
      'etiqueta'=>'Inactivo',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>23,
      'id_padre'=>NULL,
      'catalogo'=>'status_expediente',
      'etiqueta'=>'radicado',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>24,
      'id_padre'=>NULL,
      'catalogo'=>'status_expediente',
      'etiqueta'=>'remitido',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>25,
      'id_padre'=>NULL,
      'catalogo'=>'status_victima',
      'etiqueta'=>'activo',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>26,
      'id_padre'=>NULL,
      'catalogo'=>'status_victima',
      'etiqueta'=>'archivado',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>27,
      'id_padre'=>NULL,
      'catalogo'=>'status_delito',
      'etiqueta'=>'activo',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>28,
      'id_padre'=>NULL,
      'catalogo'=>'status_delito',
      'etiqueta'=>'archivado',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>29,
      'id_padre'=>NULL,
      'catalogo'=>'stutus_token',
      'etiqueta'=>'sin uso',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>30,
      'id_padre'=>NULL,
      'catalogo'=>'stutus_token',
      'etiqueta'=>'usado',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>31,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'radio',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>32,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'date',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>33,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'text',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>34,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'select',
      'activo'=>'1',
      'orden'=>4,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>35,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'checkbox',
      'activo'=>'1',
      'orden'=>5,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>36,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'textarea',
      'activo'=>'1',
      'orden'=>6,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>37,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'number',
      'activo'=>'1',
      'orden'=>7,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>38,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'option',
      'activo'=>'1',
      'orden'=>8,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>39,
      'id_padre'=>NULL,
      'catalogo'=>'tipo_input',
      'etiqueta'=>'repeater',
      'activo'=>'1',
      'orden'=>9,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>40,
      'id_padre'=>NULL,
      'catalogo'=>'status_evaluacion',
      'etiqueta'=>'Inicializado',
      'activo'=>'1',
      'orden'=>1,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>41,
      'id_padre'=>NULL,
      'catalogo'=>'status_evaluacion',
      'etiqueta'=>'Guardado',
      'activo'=>'1',
      'orden'=>2,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));

      DB::table('cm_catalogo')->insert(
      array(
      'id_cat'=>42,
      'id_padre'=>NULL,
      'catalogo'=>'status_evaluacion',
      'etiqueta'=>'Finalizado',
      'activo'=>'1',
      'orden'=>3,
      'valor'=>'',
      'user_alta'=>1,
      'user_mod'=>1,
      'fecha_alta'=>'2016-11-16 14:41:31',
      'fecha_mod'=>'2016-11-16 14:41:31'
      ));
    }
}
