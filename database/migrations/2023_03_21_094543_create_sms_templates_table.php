<?php

use App\Models\SmsTemplate;
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
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->integer('template_id')->nullable()->comment('use only for fast2sms');
            $table->text('body');
            $table->text('short_codes')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        $data = [
            [
                'key'         => 'login',
                'template_id' => 0,
                'body'        => 'Your login OTP is {otp}',
                'short_codes' => '{otp},{phone_no},{site_name}',
            ],
            [
                'key'         => 'register',
                'template_id' => 0,
                'body'        => 'Your register OTP is {otp}',
                'short_codes' => '{otp},{phone_no},{site_name}',
            ],
            /*[
                'key'         => 'forgot_password',
                'template_id' => 0,
                'body'        => 'Your recovery password OTP is {otp}',
                'short_codes' => '{otp},{phone_no},{site_name}',
            ]*/
        ];

        SmsTemplate::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_templates');
    }
};
