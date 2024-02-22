<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This is a migration class for creating the 'users' table
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is called when the migration is run using the `php artisan migrate` command.
     * It creates the 'users' table in the database with the specified columns and their data types.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // The 'id' column is of type integer and is the primary key of the table
            $table->id();

            // The 'name' column is of type string
            $table->string('name');

            // The 'email' column is of type string and is unique within the table
            $table->string('email')->unique();

            // The 'email_verified_at' column is of type timestamp and is nullable
            $table->timestamp('email_verified_at')->nullable();

            // The 'password' column is of type string
            $table->string('password');

            // The 'remember_token' column is of type string
            $table->rememberToken();

            // The 'created_at' and 'updated_at' columns are of type timestamp and are automatically maintained by Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is called when the migration is rolled back using the `php artisan migrate:rollback` command.
     * It drops the 'users' table from the database if it exists.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

