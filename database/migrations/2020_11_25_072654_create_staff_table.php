<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dept')->nullable();
            $table->foreign('id_dept')->references('id')->on('depts')->onDelete('cascade');
            $table->string('staff_name');
            $table->string('slug');
            $table->string('phone');
            $table->string('address');
            $table->string('email');
            $table->string('photo');
            $table->mediumText('story');
            $table->boolean('delete_status')->default(1);
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
        Schema::dropIfExists('staff');
    }
}
