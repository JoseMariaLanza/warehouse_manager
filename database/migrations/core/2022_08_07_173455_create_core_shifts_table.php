<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('core')->create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['pending', 'ready to pick up', 'check in', 'in progress', 'finished', 'Cancelled', 'refused'])->default('pending'); // estado del turno
            $table->string('driver_identification')->nullable(); // dni del chofer
            $table->dateTime('shift_date'); // fecha del turno
            $table->time('start_time')->nullable(); // hora inicial
            $table->time('finish_time')->nullable(); // hora final
            $table->float('init_weight', 8, 2); // peso inical
            $table->float('final_weight', 8, 2); // peso final
            $table->integer('remit'); // numero de remito
            $table->string('assigned_shipment_street'); // calle de carga asignada
            $table->enum('shift_type', ['prestressed', 'vibro-pressed'])->default('prestressed'); // tipo de turno
            $table->boolean('vip_shift')->default(false); // turno vip
            $table->enum('state_province', ['cordoba', 'tucuman'])->nullable(); // provincia
            $table->dateTime('start_shift')->nullable(); // iniciar turno
            $table->dateTime('finish_shift')->nullable(); // finalizar turno
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
