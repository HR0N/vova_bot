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

        Schema::create('tg_groups', function (Blueprint $table) {
            $table->id();
            $table->string('rent_type')->default('apartment');
            $table->string('group_title');
            $table->string('group_id');
            $table->boolean('allow_messages')->default(true);
            $table->string('city')->default('Warszawa');
            $table->string('district')->nullable();
            $table->string('price')->nullable();
            $table->string('rooms')->nullable();
            $table->mediumText('request_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tg_groups');
    }
};
