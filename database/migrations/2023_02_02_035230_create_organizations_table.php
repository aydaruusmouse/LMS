<?php

use App\Models\Organization;
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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_name');
            $table->string('slug');
            $table->string('email', 100);
            $table->unsignedBigInteger('phone_country_id');
            $table->string('phone', 50);
            $table->bigInteger('country_id')->unsigned();
            $table->text('address')->nullable();
            $table->text('tagline')->nullable();
            $table->text('logo')->nullable();
            $table->bigInteger('org_media_id')->unsigned()->nullable();
            $table->text('brand_color')->nullable();
            $table->string('tin')->nullable();
            $table->string('license')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_designation')->nullable();
            $table->string('person_email')->nullable();
            $table->unsignedBigInteger('person_country_id');
            $table->string('person_phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_details')->nullable();
            $table->text('person_image')->nullable();
            $table->unsignedBigInteger('person_media_id')->nullable();
            $table->text('about')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->timestamps();
        });

        Organization::create([
            'id'                 => 1,
            'org_name'           => 'Super Admin Organization',
            'slug'               => getSlug('organizations', 'Super Admin Organization'),
            'email'              => 'organization@spagreen.net',
            'phone'              => '017144444445',
            'country_id'         => 2,
            'person_name'        => 'Shelina Gumaje',
            'person_designation' => 'CEO',
            'person_email'       => 'gumej@gmail.com',
            'person_phone'       => '01744444444',
            'status'             => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
