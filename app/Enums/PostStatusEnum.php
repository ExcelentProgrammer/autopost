<?php

// Define a new namespace for the enum class
namespace App\Enums;

// Use the built-in enum class to create a custom enum class named PostStatusEnum
enum PostStatusEnum
{
    // Define a constant for the success status
    const success = "success";

    // Define a constant for the error status
    const error = "error";

    // Define a constant for the pending status
    const pending = "pending";
}

// The above code defines a custom enum class named PostStatusEnum with three possible constants: success, error, and pending.
// This can be used to represent the status of a post in a more type-safe and readable way.
