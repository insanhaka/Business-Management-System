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
            $table->unsignedBigInteger('business_owner_id')->nullable();
            $table->foreign('business_owner_id')->references('id')->on('business_owners')->onDelete('cascade');
            $table->string('owner');
            $table->string('name');

            $table->string('loc_province');
            $table->string('loc_regency');
            $table->string('loc_district');
            $table->string('loc_village');
            $table->string('loc_address');

            $table->string('contact');
            $table->string('photo')->nullable();
            $table->string('attachment')->nullable();
            $table->string('status', 20);
            $table->boolean('is_active')->nullable();

            $table->unsignedBigInteger('business_sectors_id')->nullable();
            $table->foreign('business_sectors_id')->references('id')->on('business_sectors')->onDelete('cascade');
            $table->unsignedBigInteger('business_category_id')->nullable();
            $table->foreign('business_category_id')->references('id')->on('business_categories')->onDelete('cascade');
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
        Schema::dropIfExists('business');
    }
}
