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
         * Creates a new table called 'routes' in the database using Laravel's schema builder.
         *
         * @param  \Illuminate\Database\Schema\Blueprint  $table
         * @return void
         */
        Schema::create('routes', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->id();
            $table->foreignId('sede_id')->references('id')->on('sedes');
            $table->string('name');
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
        Schema::dropIfExists('routes');
    }
};
