<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            if (!Schema::hasColumn('beneficiaries', 'social_worker_id')) {
                $table->unsignedBigInteger('social_worker_id')->nullable()->after('program');
                $table->foreign('social_worker_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            if (Schema::hasColumn('beneficiaries', 'social_worker_id')) {
                $table->dropForeign(['social_worker_id']);
                $table->dropColumn('social_worker_id');
            }
            
            if (Schema::hasColumn('beneficiaries', 'documents')) {
                $table->dropColumn('documents');
            }
        });
    }
}
