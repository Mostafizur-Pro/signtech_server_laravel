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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('cooling_kw');
            $table->integer('cooling_btu');
            $table->string('cooling_tr');
            $table->integer('power_input_w')->nullable();
            $table->string('air_flow_high_cfm')->nullable();
            $table->string('air_flow_medium_cfm')->nullable();
            $table->string('air_flow_low_cfm')->nullable();
            $table->string('refrigerant')->nullable();
            $table->integer('size_width_mm')->nullable();
            $table->integer('size_height_mm')->nullable();
            $table->integer('size_depth_mm')->nullable();
            $table->string('panel_model')->nullable();
            $table->string('panel_type')->nullable();
            $table->string('panel_color')->nullable();
            $table->string('regular_price');
            $table->string('offer_price');
            $table->string('inverter_type'); //interter /non inverter
            $table->string('category');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
