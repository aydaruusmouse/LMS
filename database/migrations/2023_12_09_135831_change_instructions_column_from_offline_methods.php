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
        Schema::table('offline_methods', function (Blueprint $table) {
            $table->text('instructions')->nullable()->change();
        });
        Schema::table('offline_method_languages', function (Blueprint $table) {
            $table->text('instructions')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offline_methods', function (Blueprint $table) {
            //
        });
    }
};
