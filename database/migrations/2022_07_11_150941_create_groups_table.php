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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->nullable();
            $table->integer('province_id');
            $table->boolean('is_active')->default(1);
            $table->string('group_type');
            $table->string('name', 255);
            $table->string('code', 20);
            $table->string('owner', 75);
            $table->string('contact', 50);
            $table->string('address', 255)->nullable();
            // $table->integer('active_staff')->default(0);
            // $table->integer('installed_pc')->default(0);
            $table->text('remarks')->nullable();
            // $table->string('site');
            $table->string('guarantor')->nullable();
            // $table->char('status')->nullable();
            // $table->boolean('viewing_status')->nullable();
            // $table->date('operation_date')->nullable();
            // $table->date('pullout_date')->nullable();
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
        Schema::dropIfExists('groups');
    }
};
