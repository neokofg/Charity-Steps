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
        Schema::create('charity_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignUuid("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignUuid("charity_id")->constrained("charities")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charity_users');
    }
};
