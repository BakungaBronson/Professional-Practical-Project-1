<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name');
            $table->enum('SEX', ['M', 'F']);
            $table->integer('Contact');
            $table->string('Roles');
            $table->string('Signature',1);
            $table->string('District_Assigned');
            $table->softDeletes();

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
        Schema::dropIfExists('_agents');
    }
}
