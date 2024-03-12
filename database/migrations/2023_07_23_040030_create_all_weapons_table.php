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
        Schema::create('all_weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type_weapon_id');
            $table->integer('level');
            $table->integer('min_damage');
            $table->integer('max_damage');
            $table->integer('unique_id');
            $table->longText('description');
            $table->integer('price');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_weapons');
    }
};
