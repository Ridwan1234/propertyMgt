<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoicable_id');
            $table->string('invoicable_type');
            $table->decimal('rent', 16, 2);
            $table->decimal('included_bills', 16, 2)->default(0.0);
            $table->decimal('commission', 16, 2)->default(0.0);
            $table->boolean('is_paid')->default(false);
            $table->foreignId('tenant_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->foreignId('landlord_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('NO ACTION')
                ->onDelete('SET NULL');
            $table->foreignId('lease_id')
                ->nullable()
                ->constrained('leases')
                ->onUpdate('NO ACTION')
                ->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
