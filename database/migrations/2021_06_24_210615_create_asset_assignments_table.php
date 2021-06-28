<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->string('assignment_date');
            $table->string('status');
            $table->boolean('is_due')->default(false);
            $table->date('due_date');
            $table->unsignedBigInteger('assigned_user_id');
            $table->unsignedBigInteger('assigned_by');
            $table->timestamps();

            $table->index('asset_id');
            $table->foreign('asset_id')->references('id')->on('assets');// assigning asset_id as foreign key to assets table
            $table->index('assigned_by');
            $table->foreign('assigned_by')->references('id')->on('users'); // assigning user_id as foreign key to user table
            $table->index('assigned_user_id');
            $table->foreign('assigned_user_id')->references('id')->on('vendors');// adding assigned_user_id as foreign key to vendors table id

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_assignments');
    }
}
