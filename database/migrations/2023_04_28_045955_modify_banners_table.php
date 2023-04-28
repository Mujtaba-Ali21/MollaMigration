<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('banners', function (Blueprint $table) {
        $table->string('text')->nullable()->change();
    });
}

public function down()
{
    Schema::table('banners', function (Blueprint $table) {
        $table->string('text')->nullable(false)->change();
    });
}

};
