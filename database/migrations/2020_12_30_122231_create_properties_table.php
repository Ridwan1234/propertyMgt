<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('property_type');
            $table->string('area')->nullable();
            $table->decimal('rent', 16, 2);
            $table->decimal('caution', 16, 2)->default(0);
            $table->decimal('service', 16, 2)->default(0);
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('age')->nullable();
            $table->json('amenities')->nullable();
            $table->enum('status',['vacant','occupied','unavailable'])->default('vacant');
            $table->text('notes')->nullable();

            $table->foreignId('landlord_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('users','id')
                ->onDelete('set null');
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
        Schema::dropIfExists('properties');
    }
}
