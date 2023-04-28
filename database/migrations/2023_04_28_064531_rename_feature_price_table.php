<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameFeaturePriceTable extends Migration
{
    public function up()
    {
        Schema::rename('feature_prices', 'features_prices');
    }

    public function down()
    {
        Schema::rename('features_prices', 'feature_prices');
    }
}
