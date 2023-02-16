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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('province')->nullable();
            $table->string('occupation')->nullable();
            $table->string('source_of_income')->nullable();
            $table->string('facebook')->nullable();
            $table->char('valid_id_type',10)->nullable();
            $table->string('id_picture')->nullable();
            $table->string('selfie_with_id')->nullable();
            $table->string('snapshot')->nullable();
            $table->text('interview_link')->nullable();
            $table->dateTime('interview_date_time')->nullable();
            $table->string('interview_description')->nullable();
            $table->text('remarks')->nullable();
            $table->string('video_app')->nullable();
            $table->integer('case_id')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
