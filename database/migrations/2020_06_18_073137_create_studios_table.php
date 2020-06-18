<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('branch_id');
            $table->bigInteger('basic_price');
            $table->bigInteger('additional_friday_price');
            $table->bigInteger('additional_saturday_price');
            $table->bigInteger('additional_sunday_price');
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
            
        });

        
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios');
    }
}
