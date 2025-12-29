<?php

use App\Models\OrganizationStaff;
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
        Schema::create('organization_staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->string('designation')->nullable();
            $table->string('website')->nullable();
            $table->string('expertises')->nullable();
            $table->text('social_links')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        OrganizationStaff::create([
            'id'              => 1,
            'user_id'         => 5,
            'organization_id' => 1,
            'designation'     => 'Professional Graphic & UX Designer',
            'expertises'      => [],
            'slug'            => 'organization-staff',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_staff');
    }
};
