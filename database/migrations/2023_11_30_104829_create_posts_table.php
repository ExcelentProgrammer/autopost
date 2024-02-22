<?php

// Import necessary classes and interfaces
use App\Enums\PostStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Define a new anonymous class that extends the Migration class
return new class extends Migration {
    // Define the 'up' method to create the 'posts' table
    public function up(): void
    {
        // Use the 'Schema' facade to create the 'posts' table
        Schema::create('posts', function (Blueprint $table) {
            // Define an auto-incrementing primary key column named 'id'
            $table->id();

            // Define a 'title' column that can store text data
            $table->text("title");

            // Define a 'file' column that can store text data
            $table->text("file");

            // Define a 'status' column that stores strings, with a default value of 'pending' from the 'PostStatusEnum' enum
            $table->string("status")->default(PostStatusEnum::pending);

            // Define 'created_at' and 'updated_at' columns to store timestamps
            $table->timestamps();
        });
    }

    // Define the 'down' method to drop the 'posts' table if it exists
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

