<?php

// Import necessary classes and functions from the testing namespace
namespace Tests\Feature;

// Use the TestCase class as a base for our test case
use Tests\TestCase;

// Define our test class that extends the TestCase class
class ExampleTest extends TestCase
{
    // Define a test method that starts with the word 'test'
    public function test_the_application_returns_a_successful_response(): void
    {
        // Call the GET method on the application with the specified URI
        $response = $this->get('/');

        // Assert that the response has a HTTP status code of 200
        $response->assertStatus(200);
    }
}
