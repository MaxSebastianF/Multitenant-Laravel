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
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id_service');
            $table->string('code', 50)->unique();
            $table->string('service_name', 150);
            $table->enum('type_plan', ['mensual', 'anual', 'por_usuario', 'a_llamado']);
            $table->unsignedBigInteger('id_client');
            $table->enum('status', ['activo', 'inactivo'])->nullable();

            $table->foreign('id_client')->references('id_client')->on('clients');
            $table->index('id_client');
            $table->index('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
