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
        Schema::create('company_fills', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->integer("amount");
            $table->dateTime("expDate");
            $table->enum("status",["declined","pending","completed"]);
            $table->foreignUuid("company_id")->constrained("companies")->cascadeOnDelete();
            $table->foreignUuid("user_id")->constrained("users")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_fills');
    }
};
