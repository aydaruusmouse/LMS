<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submited_assignments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('assignment_id')->unsigned()->nullable();
            $table->double('marks')->default(0.00);
            $table->string('grad', 3)->nullable();
            $table->text('file')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=submit, 1=complete, 2=fail');
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
        Schema::dropIfExists('submited_assignments');
    }
};
