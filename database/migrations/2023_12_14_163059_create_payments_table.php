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
            Schema::create('payments', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->decimal('amount', 12, 0)->nullable();
                $table->string('social_id')->nullable();
                $table->text('description')->nullable();
                $table->integer('hours')->nullable();
                $table->string('payment_status');
                $table->timestamp('payment_date')->nullable();
                $table->string('payment_method')->nullable();
                $table->string('payment_id')->nullable();
                $table->string('invoice_or_receipt')->nullable();
                $table->boolean('document_created')->default(false);
                $table->boolean('hours_added')->default(false);
                $table->foreignUuid('cliente_id')->nullable()->references('id')->on('clientes');
                $table->timestamps(); 
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            Schema::dropIfExists('payments');
        });
    }
};
