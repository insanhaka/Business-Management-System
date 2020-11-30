<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('loc_province');
            $table->string('loc_regency');
            $table->string('loc_district');
            $table->string('loc_village');
            $table->string('address');
            $table->string('owner');
            $table->string('contact');
            $table->unsignedBigInteger('business_sectors_id')->nullable();
            $table->foreign('business_sectors_id')->references('id')->on('business_sectors')->onDelete('cascade');
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('business');
    }
}
