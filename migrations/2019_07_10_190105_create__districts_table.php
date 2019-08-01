<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_districts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('District_Code',3)->unique();
            $table->string('District_Name');
            $table->integer('Number_of_Agents');
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
        Schema::dropIfExists('_districts');
    }
}
