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
        /**
         * Creates a new table called 'loans' in the database using Laravel's schema builder.
         *
         * @param void
         * @return void
         */
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->references('id')->on('routes');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->integer('order'); //Orden de cobro
            $table->decimal('amount'); //MONTO
            $table->string('paymentDays'); //fecha pago
            $table->string('paymentType'); //tipo de pago diario o mensual (MODALIDAD)
            $table->bigInteger('deposit'); //Abono diario
            $table->decimal('lastInstallment'); //ULTIMA CUOTA (PAGO)
            $table->decimal('remainingBalance'); // si da menos de la cuota (PICO)
            $table->decimal('remainingAmount'); // saldo restante

            $table->integer('daysPastDue'); // dias de mora
            $table->date('lastPayment'); // ultimo pago
            $table->date('startDate'); // fecha inicio
            $table->date('finalDate'); // fecha final
            $table->boolean('status')->default(true); // estado del credito para reencauche

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('modified_by');
            $table->foreign('modified_by')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
