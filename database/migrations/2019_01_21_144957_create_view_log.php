<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
        "CREATE
        ALGORITHM=Undefined
        DEFINER=`root`@`localhost`
        SQL SECURITY Definer
        VIEW `view_log` AS
        SELECT
        `fw_login`.`id_login` AS `id_login`,
        `fw_login`.`open` AS `open`,
        `fw_login`.`fecha_login` AS `fecha_login`,
        `fw_login`.`ultima_verificacion` AS `ultima_verificacion`,
        `fw_login`.`fecha_logout` AS `fecha_logout`,
        `fw_login`.`tiempo_session` AS `tiempo_session`,
        `fw_login`.`ipv4` AS `ipv4`,
        `fw_usuarios`.`usuario` AS `usuario`,
        `fw_roles`.`descripcion` AS `descripcion`
        FROM
        (((`fw_login`
        JOIN `fw_usuarios` ON ((`fw_login`.`id_usuario` = `fw_usuarios`.`id_usuario`)))
        JOIN `fw_roles` ON ((`fw_usuarios`.`id_rol` = `fw_roles`.`id_rol`))));"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_log");
    }
}
