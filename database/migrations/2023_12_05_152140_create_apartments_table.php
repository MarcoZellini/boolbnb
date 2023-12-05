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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('rooms')->default(1);
            $table->unsignedTinyInteger('beds')->default(1);
            $table->unsignedTinyInteger('bethrooms')->default(1);
            $table->unsignedSmallInteger('square_meters')->nullable();
            $table->string('address', 255)->nullable(0);
            $table->float('latitude', 8, 6)->nullable(0);
            $table->float('longitude', 9, 6)->nullable(0);
            $table->boolean('is_visible')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign('apartments_user_id_foreign');
        });

        Schema::dropIfExists('apartments');
    }
};
