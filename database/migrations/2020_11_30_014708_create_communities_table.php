<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('chairman_name', 100)->nullable();
            $table->bigInteger('chairman_nik')->nullable();

            $table->string('office_loc_province');
            $table->string('office_loc_regency');
            $table->string('office_loc_district');
            $table->string('office_loc_village');
            $table->string('office_address');

            $table->string('created_by', 50);
            $table->string('updated_by', 50)->nullable();
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
        Schema::dropIfExists('communities');
    }
}
