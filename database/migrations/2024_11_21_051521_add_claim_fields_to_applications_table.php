<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClaimFieldsToApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('claim_status')->default('Unclaimed'); // Unclaimed or Claimed
            $table->date('claim_date')->nullable(); // Date of claim
            $table->decimal('claimed_amount', 10, 2)->nullable(); // Amount claimed
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['claim_status', 'claim_date', 'claimed_amount']);
        });
    }
}
