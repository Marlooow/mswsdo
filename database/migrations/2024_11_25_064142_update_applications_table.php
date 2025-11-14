<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop the old program column if it exists
            if (Schema::hasColumn('applications', 'program')) {
                $table->dropColumn('program');
            }
            
            // Add program_id if it doesn't exist
            if (!Schema::hasColumn('applications', 'program_id')) {
                $table->foreignId('program_id')->constrained('programs');
            }
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('program')->nullable(); // Restore the old column
            $table->dropForeign(['program_id']);
            $table->dropColumn('program_id');
        });
    }
};