<?php

// Define the namespace for this file
namespace Tests;

// Import the BaseTestCase class from Illuminate\Foundation\Testing
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

// Define an abstract class named TestCase that extends BaseTestCase
abstract class TestCase extends BaseTestCase
{
    // Include the CreatesApplication trait
    use CreatesApplication;
}

