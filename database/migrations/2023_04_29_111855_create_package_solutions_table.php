<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('package_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->double('price')->default(0.00);
            $table->integer('validity')->nullable();
            $table->integer('upload_limit')->nullable();
            $table->integer('add_limit')->nullable();
            $table->integer('bundle')->nullable();
            $table->tinyInteger('facilities')->default(1)->comment('1=yes, 0=no');
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_solutions');
    }
};
