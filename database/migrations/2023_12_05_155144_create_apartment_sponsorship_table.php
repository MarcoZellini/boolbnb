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
        Schema::create('apartment_sponsorship', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->unsignedBigInteger('sponsorship_id');
            $table->dateTime('end_date');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships');
            $table->primary(['apartment_id', 'sponsorship_id', 'created_at'], 'apartment_sponsorship_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table->dropForeign('apartment_sponsorship_sponsorship_id_foreign');
            $table->dropForeign('apartment_sponsorship_apartment_id_foreign');
        });

        Schema::dropIfExists('apartment_sponsorship');
    }
};
