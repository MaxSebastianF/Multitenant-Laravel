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
        Schema::create('suscriptions', function (Blueprint $table) {
            $table->bigIncrements('id_suscrption');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_service');
            $table->unsignedBigInteger('id_supplier');
            $table->date('start_date');
            $table->date('cut_date');
            $table->enum('status', ['pendiente', 'pagado', 'cuarentena']);
            $table->decimal('suscription_price', 10, 2);

            $table->foreign('id_client')->references('id_client')->on('clients');
            $table->foreign('id_service')->references('id_service')->on('services');
            $table->foreign('id_supplier')->references('id_supplier')->on('suppliers');

            $table->unique(['id_client', 'id_service', 'id_supplier', 'start_date'], 'unique_suscription');

            $table->index('id_client');
            $table->index('id_service');
            $table->index('id_supplier');
            $table->index('status');
            $table->index('cut_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscriptions');
    }
};
