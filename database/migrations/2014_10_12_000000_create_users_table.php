<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('phone_country_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->json('permissions')->nullable();
            $table->enum('user_type', ['admin', 'stuff', 'instructor', 'student', 'organization-staff'])->default('student');
            $table->string('firebase_auth_id')->nullable()->comment('this is for mobile app.');
            $table->bigInteger('language_id')->unsigned()->nullable();
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->text('images')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_password_change')->nullable();
            $table->tinyInteger('is_user_banned')->default(0)->comment('0 not banned, 1 banned');
            $table->tinyInteger('is_deleted')->default(0)->comment('0 not delete, 1 deleted');
            $table->bigInteger('role_id')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('state_id')->unsigned()->nullable();
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->string('gender', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('about')->nullable();
            $table->tinyInteger('is_newsletter_enabled')->default(0)->comment('1=newsletter enable, 0= not newsletter enable');
            $table->tinyInteger('is_notification_enabled')->default(0)->comment('1=Notification enable, 0= not Notification enable');
            $table->double('balance')->default(0.00);
            $table->integer('otp')->nullable();
            $table->string('onesignal_player_id')->nullable();
            $table->boolean('is_onesignal_subscribed')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        $now  = now();
        $data = [
            [
                'first_name'        => 'Super',
                'last_name'         => 'Admin',
                'email'             => 'admin@spagreen.net',
                'password'          => bcrypt('123456'),
                'phone'             => '017111131111',
                'address'           => 'Dhaka, Bangladesh',
                'gender'            => 'male',
                'user_type'         => 'admin',
                'role_id'           => 1,
                'email_verified_at' => $now,
                'date_of_birth'     => date('Y-m-d', strtotime('Y-m-d'.'- 30 year')),
                'created_at'        => $now,
                'updated_at'        => $now,
                'about'             => '',
            ],
            [
                'first_name'        => 'Mr.',
                'last_name'         => 'Instructor',
                'email'             => 'instructor@spagreen.net',
                'password'          => bcrypt('123456'),
                'phone'             => '017111132111',
                'address'           => 'Dhaka, Bangladesh',
                'gender'            => 'male',
                'role_id'           => 2,
                'user_type'         => 'instructor',
                'email_verified_at' => $now,
                'date_of_birth'     => date('Y-m-d', strtotime('Y-m-d'.'- 30 year')),
                'created_at'        => $now,
                'updated_at'        => $now,
                'about'             => "Dedicated, resourceful and goal-driven professional educator with a solid commitment to the social and academic growth and development of every child.An accommodating and
            versatile individual with the talent to develop inspiring hands-on lessons that will capture a child's imagination and breed success. Highly motivated, enthusiastic and dedicated educator
            who wants all children to be successful learners.
            Committed to creating a classroom atmosphere that is stimulating and encouraging to students. Aptitude to remain flexible, ensuring that every child's learning styles and abilities are
            addressed.Superior interpersonal and communication skills to foster meaningful relationships with students, staff and parents Demonstrated ability to consistently individualize instruction, based on student's needs and interests
            Exceptional ability to establish cooperative, professional relationships with parents, staff and administration.
            Professional Educator with diverse experience and strong track record fostering child-centered curriculum and student creativity.
            Warm and caring teacher who wants all children to be successful learners and works to create a classroom atmosphere that is stimulating, encouraging, and adaptive to the varied needs of students.",
            ],
            [
                'first_name'        => 'Mr.',
                'last_name'         => 'Student',
                'email'             => 'student@spagreen.net',
                'password'          => bcrypt('123456'),
                'phone'             => '017116546511111',
                'address'           => 'Dhaka, Bangladesh',
                'gender'            => 'male',
                'user_type'         => 'student',
                'role_id'           => 3,
                'email_verified_at' => $now,
                'date_of_birth'     => date('Y-m-d', strtotime('Y-m-d'.'- 30 year')),
                'created_at'        => $now,
                'updated_at'        => $now,
                'about'             => '',
            ],
            [
                'first_name'        => 'Mr.',
                'last_name'         => 'Staff',
                'email'             => 'staff@spagreen.net',
                'password'          => bcrypt('123456'),
                'phone'             => '0171153411111',
                'address'           => 'Dhaka, Bangladesh',
                'gender'            => 'male',
                'user_type'         => 'stuff',
                'role_id'           => 4,
                'email_verified_at' => $now,
                'date_of_birth'     => date('Y-m-d', strtotime('Y-m-d'.'- 30 year')),
                'created_at'        => $now,
                'updated_at'        => $now,
                'about'             => '',
            ],
            [
                'first_name'        => 'Organization',
                'last_name'         => 'Staff',
                'email'             => 'org_staff@spagreen.net',
                'password'          => bcrypt('123456'),
                'phone'             => '0171153411111',
                'address'           => 'Dhaka, Bangladesh',
                'gender'            => 'male',
                'user_type'         => 'organization-staff',
                'role_id'           => 5,
                'email_verified_at' => $now,
                'date_of_birth'     => date('Y-m-d', strtotime('Y-m-d'.'- 30 year')),
                'created_at'        => $now,
                'updated_at'        => $now,
                'about'             => '',
            ],
        ];

        User::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
