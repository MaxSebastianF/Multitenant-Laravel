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
        Schema::create('specs', function (Blueprint $table) {
            $table->bigIncrements('id_specs');
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_service');

            $table->foreign('id_service')->references('id_service')->on('services');
            $table->index('id_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specs');
    }
};
