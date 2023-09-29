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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->string("title");
            $table->text("content");
            $table->foreignUuid("charity_id")->nullable()->constrained("charities")->nullOnDelete();
            $table->foreignUuid("company_id")->nullable()->constrained("companies")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
