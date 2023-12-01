<?php

namespace App\Services\Autopost;

use App\Helpers\Autopost\Webdriver;
use App\Helpers\Helpers;
use Facebook\WebDriver\WebDriverBy;
use Throwable;

class AutopostService
{
    public string|null $url;
    public Webdriver $driver;

    public string|null $title;

    public string|null $file;

    public function __construct($title, $file, $url = null)
    {
        $this->title = $title;
        $this->file = $file;
        $this->driver = new Webdriver($url, headless: false, save_data: true);
    }

    /**
     * @param null $url
     * @return bool
     */
    public function instagram($url = null): bool
    {
        try {
            $this->driver->url = $url ?? "https://www.instagram.com";
            $driver = $this->driver;
            $driver->start();
            sleep(2);
            $el = $driver->driver->findElement(WebDriverBy::xpath("//div[contains(@class,'x1iyjqo2 xh8yej3')]"))->findElements(WebDriverBy::xpath("//div[@class='x1n2onr6']"));
            $el[7]->click();
            sleep(2);
            $el = $driver->driver->findElement(WebDriverBy::xpath("//input[@class='_ac69']"));
            $el->sendKeys($this->file);
            sleep(2);
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));
            sleep(2);
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));
            sleep(2);
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));
            return true;
        } catch (Throwable $exception) {
            Helpers::log($exception->getMessage());
            return false;
        }
    }

    /**
     * @param null $url
     * @return bool
     */
    public function facebook($url = null): bool
    {
        try {
            $this->driver->url = $url ?? "https://www.facebook.com";
            $driver = $this->driver;
            $driver->start();

            $driver->click(by: WebDriverBy::xpath("//div[@aria-label='Menyu']"));
            sleep(5);
            $driver->click(by: WebDriverBy::xpath("/html/body/div[1]/div/div[1]/div/div[2]/div[5]/div[2]/div/div/div[1]/div[1]/div/div/div/div/div/div[2]/div[1]/div/div/div[2]/div[2]/div/div/div[2]/div[1]"));
            sleep(2);
            $driver->driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[1]/div[1]/div/div/div[1]/p"))->sendKeys($this->title);
            sleep(2);
            $driver->click(by: WebDriverBy::xpath("/html/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[3]/div[1]"));
            sleep(3);
            $driver->driver->findElement(WebDriverBy::xpath('//*[@id="facebook"]/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[2]/div/div[1]/div/div/input'))->sendKeys($this->file);
            sleep(3);
            $driver->click(by: WebDriverBy::xpath('//*[@id="facebook"]/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[3]/div[4]/div'));
            return true;
        } catch (Throwable $exception) {
            Helpers::log($exception->getMessage());
            return false;
        }
    }

    /**
     * @param $url
     * @return bool
     */
    public function threads($url = null): bool
    {
        try {
            $this->driver->url = $url ?? "https://www.threads.net";
            $driver = $this->driver;
            $driver->start();

            $el = $driver->driver->findElements(WebDriverBy::xpath("//div[@role='button']"));
            $el[0]->click();
            sleep(5);
            $driver->driver->findElement(WebDriverBy::xpath("//div[@data-lexical-editor='true']"))->sendKeys($this->title);
            sleep(1);
            $driver->driver->findElement(WebDriverBy::xpath("//input[@type='file']"))->sendKeys($this->file);
            sleep(1);
            $driver->driver->findElement(WebDriverBy::xpath("/html/body/div[4]/div[1]/div/div[2]/div/div/div/div[2]/div/div/div/div[2]/div/div[2]/div/div[1]/div"))->click();
            return true;
        } catch (Throwable $exception) {
            Helpers::log($exception->getMessage());
            return false;
        }
    }
}

