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
        Schema::create('vrf_projects', function (Blueprint $table) {
            $table->id();

            $table->string('project_name');
            $table->string('client_name');
            $table->string('location');
            $table->string('brand');
            $table->string('capacity')->nullable();

            $table->json('equipment_list')->nullable();
            $table->text('description')->nullable();
            $table->string('indoor_type')->nullable();
            $table->string('outdoor_type')->nullable();
            $table->string('image')->nullable();

            $table->json('drawings')->nullable();
            $table->text('remarks')->nullable();

            $table->date('start_date')->nullable();
            $table->date('completed_date')->nullable();

            $table->enum('status', ['active', 'pending', 'ongoing', 'completed', 'cancelled'])->default('active');

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('vrf_projects');
    }
};
