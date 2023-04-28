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
        Schema::create('top_sellings_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('price');
            $table->unsignedBigInteger('top_selling_id');
            $table->timestamps();

            $table->foreign('top_selling_id')->references('id')->on('top_sellings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_sellings_prices');
    }
};
