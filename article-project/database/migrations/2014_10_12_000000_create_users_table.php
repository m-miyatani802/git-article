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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->integer('gender')->nullable();
            $table->date('birth')->nullable();
            $table->string('open_email')->nullable();
            $table->string('site_url')->nullable();
            $table->string('self_introduction')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->datetime('is_delete')->nullable();
            $table->integer('why_quit')->nullable();
            $table->string('quit_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
