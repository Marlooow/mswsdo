<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('surname', 255);
            $table->date('dob');
            $table->string('sex', 20)->nullable();
            $table->text('address');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('program'); 
            $table->unsignedBigInteger('program_id');
            $table->enum('status', ['pending', 'approved', 'disapproved']);
            $table->unsignedBigInteger('social_worker_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamp('approved_date')->nullable();
            $table->timestamp('date_released')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('social_worker_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
