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
         * Creates a new table called 'clients' in the database.
         *
         * @param void
         * @return void
         */
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('document_type');
            $table->string('document_number')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('address');
            $table->string('profession');
            $table->text('notes')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
