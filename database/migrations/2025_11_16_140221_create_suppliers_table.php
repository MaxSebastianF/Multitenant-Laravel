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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id_supplier');
            $table->ipAddress('ip_direction')->nullable();
            $table->string('url', 255)->nullable();
            $table->string('supplier_name', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('linked_email', 150)->nullable();
            $table->date('cut_date')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->enum('pay_type', ['mensual', 'anual'])->nullable();
            $table->enum('status', ['activo', 'pendiente_de_pago', 'desactivado'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
