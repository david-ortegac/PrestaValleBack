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
            $table->integer('amount'); //MONTO a prestar
            $table->integer('dailyPayment'); //cuanto paga por dia
            $table->integer('daysToPay'); //cuantos dias va a pagar
            $table->string('paymentDays')->default('*'); //dias en los que paga el cliente (reporte)
            $table->integer('deposit'); //Abono diario
            $table->integer('pico'); //resta entre el valor del deposito y
            $table->date('date'); // fecha del pago
            $table->integer('daysPastDue'); // dias de mora
            $table->integer('balance'); // salgo a pagar (amount - deposit)
            $table->integer('dues'); // cuotas pagadas ( solo se valida si paga una cuota de las pactadas en payment days)
            $table->date('lastPayment'); // fecha ultimo pago
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
