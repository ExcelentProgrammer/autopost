<?php

namespace App\Services\Autopost;

use App\Helpers\Autopost\Webdriver;
use App\Helpers\Helpers;
use Facebook\WebDriver\WebDriverBy;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Env;
use JetBrains\PhpStorm\NoReturn;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;
use Throwable;

class AutopostService
{
    // Property to store the URL for the webdriver
    public string|null $url;

    // Property to store the Webdriver object
    public Webdriver $driver;

    // Property to store the post title
    public string|null $title;

    // Property to store the file path of the image to be posted
    public string|null $file;

    // Property to store the sleep time between actions
    public int $sleep;

    /**
     * Constructor to initialize the properties
     * @param string $title - The title of the post
     * @param string $file - The file path of the image to be posted
     * @param string|null $url - The URL to navigate the webdriver to (optional)
     */
    public function __construct(string $title, string $file, string|null $url = null)
    {
        // Fix the unicode characters in the title
        $this->title = $this->fixUnicode($title);

        // Save the image to the storage directory
        $file_path = storage_path("app/posts/image.jpg");
        file_put_contents($file_path, file_get_contents($file));
        $this->file = $file_path;

        // Set the sleep time to 5 seconds
        $this->sleep = 5;

        // Initialize the Webdriver object
        $this->driver = new Webdriver($url, headless: false, save_data: true);
    }

    /**
     * Method to fix unicode characters in a string
     * @param string $text - The string to fix unicode characters in
     * @return string - The string with fixed unicode characters
     */
    public function fixUnicode(string $text): string
    {
        // Remove HTML tags from the string
        $text = strip_tags($text);

        // Initialize the fixed string
        $fixedText = '';

        // Loop through each character in the string
        for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');

            // If the character takes up more than one byte, add an empty string
            // to the fixed string, else add the character
            if (strlen($char) > 1) {
                $fixedText .= "";
            } else {
                $fixedText .= $char;
            }
        }

        // Return the fixed string
        return $fixedText;
    }

    /**
     * Method to post to Instagram
     * @param string|null $url - The URL to navigate the webdriver to (optional)
     * @return bool - True if the post was successful, false otherwise
     * @throws Throwable
     */
    public function instagram(string|null $url = null): bool
    {
        try {
            // Set the URL for the webdriver
            $this->driver->url = $url ?? "https://www.instagram.com";

            // Start the webdriver
            $driver = $this->driver;
            $driver->start();

            // Click on the paper plane icon to open the post creation screen
            sleep($this->sleep);
            $driver->click(by: WebDriverBy::xpath('/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div[1]/div/div/div/div/div[2]/div[7]/div/span/div/a'));

            // Wait for 5 seconds
            sleep($this->sleep);

            // Find the file input element and set its value to the file path
            $el = $driver->driver->findElement(WebDriverBy::xpath("//input[@class='_ac69']"));
            $el->sendKeys($this->file);

            // Wait for 5 seconds
            sleep($this->sleep);

            // Click on the next button
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));

            // Wait for 5 seconds
            sleep($this->sleep);

            // Click on the next button again
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));

            // Wait for 5 seconds
            sleep($this->sleep);

            // Find the textarea element and set its value to the title
            $driver
