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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->integer('user_type_id');
            $table->boolean('is_active')->default(1);
            $table->char('status', 30)->nullable();
            $table->char('site_status', 30)->nullable();
            $table->integer('contact',11)->unique();
            $table->text('session_id')->nullable();
            $table->char('group_code',5)->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->integer('processed_by')->nullable();
            $table->integer('review_by')->nullable();
            $table->integer('is_black_listed')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
