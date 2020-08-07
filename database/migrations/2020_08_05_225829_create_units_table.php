<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('integration_number')->unique();
            $table->unsignedBigInteger('contract_id');
            $table->string('email')->unique();
            $table->string('state', 2);
            $table->string('city', 100);
            $table->string('image');
            $table->enum('type', ['0', '1', '2', '3']);
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();

            $table->foreign('contract_id')
                            ->references('id')
                            ->on('contracts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
