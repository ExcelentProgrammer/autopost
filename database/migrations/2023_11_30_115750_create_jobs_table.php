<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new migration class that extends the Migration class provided by Laravel
return new class extends Migration
{
    // Run the migration methods

    /**
     * Run the migrations.
     * This method will be called when the migration is run using the `php artisan migrate` command
     */
    public function up(): void
    {
        // Create the 'jobs' table using the Schema facade and the create method
        Schema::create('jobs', function (Blueprint $table) {
            // Define an auto-incrementing primary key column with the name 'id' and a data type of bigInteger
            $table->bigIncrements('id');
            // Define a string column with the name 'queue' and a length of 255 characters
            $table->string('queue')->index();
            // Define a text column with the name 'payload' that can store long strings of text
            $table->longText('payload');
            // Define an unsigned tiny integer column with the name 'attempts'
            $table->unsignedTinyInteger('attempts');
            // Define an unsigned integer column with the name 'reserved_at' that can be null
            $table->unsignedInteger('reserved_at')->nullable();
            // Define an unsigned integer column with the name 'available_at'
            $table->unsignedInteger('available_at');
            // Define an unsigned integer column with the name 'created_at'
            $table->unsignedInteger('created_at');
        });
    }

    /**
     * Reverse the migrations.
     * This method will be called when the migration is rolled back using the `php artisan migrate:rollback` command
     */
    public function down(): void
    {
        // Drop the 'jobs' table if it exists using the Schema facade and the dropIfExists method
        Schema::dropIfExists('jobs');
    }
};

