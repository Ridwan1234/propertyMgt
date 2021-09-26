<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leasable_id');
            $table->string('leasable_type');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->decimal('paid',12,2)->nullable();
            $table->text('terms')->nullable();
            $table->date('invoice_generated_on')->default(now()->addMonthNoOverflow());
            $table->foreignId('tenant_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('landlord_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('NO ACTION')
                ->onDelete('set null')
            ;
            $table->softDeletes();
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
        Schema::dropIfExists('leases');
    }
}
