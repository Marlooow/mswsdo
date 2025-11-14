<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBatchReleaseFieldsToApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('batch_id')->nullable(); // Unique batch identifier
            $table->timestamp('batch_release_date')->nullable(); // Batch release date
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['batch_id', 'batch_release_date']);
        });
    }
}
