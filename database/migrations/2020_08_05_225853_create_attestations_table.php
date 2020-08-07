<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attestations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('pacient_id');
            $table->string('companion')->nullable();
            $table->enum('demise', ['0', '1'])->default('0');
            $table->string('attestation_id')->unique();

            $table->timestamps();

            $table->foreign('contract_id')
                            ->references('id')
                            ->on('contracts');

            $table->foreign('pacient_id')
                            ->references('id')
                            ->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attestations');
    }
}
