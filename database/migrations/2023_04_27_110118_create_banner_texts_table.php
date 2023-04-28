<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTextsTable extends Migration
{
    public function up()
    {
        Schema::create('banner_texts', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedBigInteger('banner_id');
            $table->timestamps();

            $table->foreign('banner_id')->references('id')->on('banners')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_texts');
    }
}

