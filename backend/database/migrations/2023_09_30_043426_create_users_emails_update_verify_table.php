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
        Schema::create('users_emails_update_verify', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->timestamps();
            $table->integer("code")->unique();
            $table->string("email")->unique();
            $table->foreignUuid("user_id")->constrained("users")->cascadeOnDelete();

            $table->index("code");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_emails_update_verify');
    }
};
