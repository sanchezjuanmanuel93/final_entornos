<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddForeignKeysToPostulacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('postulacion', function(Blueprint $table)
		{
			$table->foreign('id_vacante', 'fk_postulacion_vacante')->references('id')->on('vacante')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('postulacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_postulacion_vacante');
		});
	}

}
