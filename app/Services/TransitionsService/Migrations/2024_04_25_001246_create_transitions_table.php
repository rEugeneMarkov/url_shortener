<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('transitionable_id');
            $table->string('transitionable_type');
            $table->string('ip_address');
            $table->string('country');
            $table->string('city');
            $table->string('os');
            $table->string('browser');
            $table->string('device');
            $table->string('user_agent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transitions');
    }
};
