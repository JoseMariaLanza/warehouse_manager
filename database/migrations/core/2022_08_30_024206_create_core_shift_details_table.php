<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreShiftDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('core')->create('shift_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_id')->constrained();
            $table->string('product_code'); // codigo articulo
            $table->string('product_description', 255)->nullable(); // descripcion articulo
            $table->integer('quantity'); // contidad
            $table->string('order_description'); // nv=nota de venta/nro de referencia del pedido
            $table->string('np_comment'); // comentarioNP
            $table->string('receipt_type'); // tipo de comprobante
            $table->string('sales_line'); // linea_nv=linea de venta
            $table->enum('state_province', ['cordoba', 'tucuman'])->nullable(); // provincia
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
        Schema::dropIfExists('shift_details');
    }
}
