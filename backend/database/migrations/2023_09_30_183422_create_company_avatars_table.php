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
        Schema::create('company_avatars', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->string("url");
            $table->string("url_128")->nullable();
            $table->string("url_256")->nullable();
            $table->string("url_512")->nullable();
            $table->string("url_1024")->nullable();
            $table->foreignUuid("company_id")->constrained("companies")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_avatars');
    }
};
