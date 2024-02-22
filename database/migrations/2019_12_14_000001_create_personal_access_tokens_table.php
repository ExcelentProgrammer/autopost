<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// This is a Laravel migration class that creates a 'personal_access_tokens' table
// when the 'up' method is called, and drops the table when the 'down' method is called

// The class uses the PHP 8 'new class' syntax to create an anonymous class that extends Laravel's Migration class
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method contains the logic for creating the 'personal_access_tokens' table
     */
    public function up(): void
    {
        // Create the 'personal_access_tokens' table using Laravel's Schema builder
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            // Add an 'id' column as the primary key
            $table->id();

            // Add a 'tokenable' column that can store a morphable relationship
            // This allows the token to be associated with any Eloquent model
            $table->morphs('tokenable');

            // Add a 'name' column to store the name of the token
            $table->string('name');

            // Add a 'token' column to store the token value
            // This column is unique to prevent duplicate tokens
            $table->string('token', 64)->unique();

            // Add an 'abilities' column to store the abilities of the token
            // This column is a text field that can store a JSON string
            $table->text('abilities')->nullable();

            // Add a 'last_used_at' column to store the last time the token was used
            $table->timestamp('last_used_at')->nullable();

            // Add an 'expires_at' column to store the expiration time of the token
            $table->timestamp('expires_at')->nullable();

            // Add 'created_at' and 'updated_at' columns to store the creation and update timestamps
            $table->timestamps();
        });
    }

   
