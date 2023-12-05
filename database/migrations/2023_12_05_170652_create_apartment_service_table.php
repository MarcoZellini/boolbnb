<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartment_service', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('service_id');

            $table->foreign('apartment_id')->on('apartments')->references('id');
            $table->foreign('service_id')->on('services')->references('id');

            $table->primary(['apartment_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign('apartment_service_apartment_id_foreign');
            $table->dropForeign('apartment_service_service_id_foreign');
        });
        Schema::dropIfExists('apartment_service');
    }
};
