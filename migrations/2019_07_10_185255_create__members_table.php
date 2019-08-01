<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('MemberID')->unique();
            $table->string('Name');
            $table->enum('Sex',['M', 'F']);
            $table->integer('Contact');
            $table->string('Recommended_By');
            $table->string('District');
            $table->string('Agent');
            
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
        Schema::dropIfExists('_members');
    }
}
