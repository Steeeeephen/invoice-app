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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            // foreignId method creates an unsigned bigint equivalent column and constrained() determines the table and column that is referenced.
            // So based on 'customer_id' it knows that we're looking for the 'id' column in the 'customers' table.
            // constrained() also creates the foreign key constraint which enforces referential
            // integrity (can't add an invoice for a customer that doesn't exist).
            // cascadeOnDelete means that if the customer that is linked to the invoice is deleted, all invoices linked to that customer will be deleted also.
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->text('description');
            $table->decimal('amount_due', 10, 2);
            $table->date('due_date')->nullable();
            $table->date('paid_at')->nullable();
            $table->enum('status', ['draft', 'sent', 'paid', 'cancelled'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
