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
            $table->string('title');
            $table->string('category')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('regular_price', 8, 2)->nullable();
            $table->string('size')->nullable();
            $table->string('refrigerant')->nullable();
            $table->string('general')->nullable();
            $table->string('capacity')->nullable();
            $table->string('power')->nullable();
            $table->string('model')->nullable();
            $table->string('unit')->nullable();
            $table->string('type')->nullable();
            $table->text('image')->nullable();
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
