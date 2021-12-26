<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('card_number')->unique()->comment('Auto Generate..');
            $table->string('password');
            $table->string('date_of_birth');
            $table->string('gender')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('parent_membership_number')->nullable();
            $table->string('parent_title')->nullable();
            $table->string('parent_first_name')->nullable();
            $table->string('parent_middle_name')->nullable();
            $table->string('parent_last_name')->nullable();

            $table->string('nationality')->nullable()->comment('Country selectable..');
            $table->string('region_of_residence')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('document')->nullable();

            $table->string('house_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('land_mark')->nullable();
            $table->boolean('term_and_condition')->default(0);
            $table->string('activation_token')->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('blocked')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->rememberToken();
            $table->nullableTimestamps();
        });
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
}
