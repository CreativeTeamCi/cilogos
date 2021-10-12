<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLibelleFieldToLabelInActivityAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_areas', function (Blueprint $table) {
            $table->renameColumn('libelle', 'label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_areas', function (Blueprint $table) {
            $table->renameColumn('label', 'libelle');
        });
    }
}
