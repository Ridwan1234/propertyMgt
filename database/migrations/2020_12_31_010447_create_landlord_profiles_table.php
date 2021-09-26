<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandlordProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlord_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('identity')->nullable();
            $table->string('identity_document')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->string('bank_name')->nullable();
            $table->string('bank_account')->nullable();

            $table->foreignId('landlord_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('landlord_profiles');
    }
}
