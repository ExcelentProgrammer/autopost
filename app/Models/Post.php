<?php

// Specify the namespace for this model
namespace App\Models;

// Import necessary classes and traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Define the Post model
class Post extends Model
{
    // Use the HasFactory trait to enable model factories
    use HasFactory;

    // Define the fillable properties for mass assignment
    protected $fillable = [
        // The title of the post
        "title",

        // The file associated with the post (e.g. image, document)
        "file",

        // The status of the post (e.g. published, draft)
        "status"
    ];
}

