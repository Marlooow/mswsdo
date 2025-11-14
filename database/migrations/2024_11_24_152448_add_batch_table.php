<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBatchTable extends Migration
{
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('social_worker_id');
            $table->date('release_date');
            $table->enum('status', ['Pending', 'Released'])->default('Pending');
            $table->text('remarks')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('social_worker_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('batches');
    }
}
