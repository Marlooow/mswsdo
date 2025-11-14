<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameExtensionAndPlaceOfBirthToBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            // Add name_extension column
            $table->string('name_extension', 255)->nullable()->after('surname');
            
            // Add place_of_birth column
            $table->string('place_of_birth', 255)->nullable()->after('dob');
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
            // Drop name_extension column
            $table->dropColumn('name_extension');
            
            // Drop place_of_birth column
            $table->dropColumn('place_of_birth');
        });
    }
}
