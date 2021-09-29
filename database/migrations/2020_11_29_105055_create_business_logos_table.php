<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessLogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_logos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_areas_id')->constrained('activity_areas')->nullable();
            $table->string('name');
            $table->string('business_name');
            $table->string('business_name_slug');
            $table->string('email');
            $table->string('url')->nullable();
            $table->string('logo_png');
            $table->string('logo_svg')->nullable();
            $table->enum('status', ['soumis', 'valide'])->default('soumis');
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
        Schema::dropIfExists('business_logos');
    }
}
