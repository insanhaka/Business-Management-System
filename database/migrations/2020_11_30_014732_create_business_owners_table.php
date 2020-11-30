<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('nik');

            $table->string('domisili_loc_province');
            $table->string('domisili_loc_regency');
            $table->string('domisili_loc_district');
            $table->string('domisili_loc_village');
            $table->string('domisili_address');
            $table->string('ktp_loc_province');
            $table->string('ktp_loc_regency');
            $table->string('ktp_loc_district');
            $table->string('ktp_loc_village');
            $table->string('ktp_address');

            $table->string('photo')->nullable();
            $table->string('attachment', 100)->nullable();
            $table->string('status', 20);
            $table->unsignedBigInteger('community_id')->nullable();
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');

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
        Schema::dropIfExists('business_owners');
    }
}
