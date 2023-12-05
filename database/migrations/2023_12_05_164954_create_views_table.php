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
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->string('ip_address', 15);
            $table->dateTime('date');
            $table->timestamps();

            $table->foreign('apartment_id')->references('id')->on('apartments');
        });

        /* Schema::table('views', function ($table) {
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('views_apartment_id_foreign');
        });

        Schema::dropIfExists('views');
    }
};
