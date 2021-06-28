<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->char('serial_number');
            $table->string('description');
            $table->string('fixed_or_movable');
            $table->string('picture_path');
            $table->date('purchase_date');
            $table->string('purchase_price');
            $table->date('start_use_date');
            $table->date('purchase_expiry_date');
            $table->integer('degradation_in_years');
            $table->string('current_value_in_naira');
            $table->string('warranty_expiry_date');
            $table->string('location');
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
        Schema::dropIfExists('assets');
    }
}
