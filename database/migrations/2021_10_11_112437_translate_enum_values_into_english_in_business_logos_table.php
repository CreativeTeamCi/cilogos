<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TranslateEnumValuesIntoEnglishInBusinessLogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_logos', function (Blueprint $table) {
            $table->enum('status', ['submitted', 'validated'])->default('submitted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_logos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
