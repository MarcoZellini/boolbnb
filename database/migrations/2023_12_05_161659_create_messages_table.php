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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id');
            $table->string('name', 320);
            $table->string('lastname', 320);
            $table->string('email', 320);
            $table->string('phone', 15);
            $table->string('subject', 100);
            $table->text('message');
            $table->timestamps();

            $table->foreign('apartment_id')->references('id')->on('apartments');
        });

        Schema::table('messages', function ($table) {
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_apartment_id_foreign');
        });

        Schema::dropIfExists('messages');
    }
};
