<?php


namespace App\Helpers\Autopost;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use JetBrains\PhpStorm\NoReturn;

class Webdriver
{

    public RemoteWebDriver $driver;
    public mixed $url;

    #[NoReturn] function __construct($url, $headless = false, $save_data = false)
    {
        $this->url = $url;
        $options = new ChromeOptions();
        $options->setExperimentalOption('excludeSwitches', ['enable-automation']);

        $options->addArguments(['--window-size=1920,1200']);


        if ($headless)
            $options->addArguments(['-headless']);
        if ($save_data) {
            $options->addArguments(['--user-data-dir=data']);
        }
        $options->addArguments(['--no-sandbox', '--disable-dev-shm-usage', '--enable-logging']);

        $service = DesiredCapabilities::chrome();
        $service->setCapability(ChromeOptions::CAPABILITY, $options);
        $serverUrl = 'http://localhost:9515/';
        $this->driver = RemoteWebDriver::create($serverUrl, $service);

    }

    function start(): void
    {
        $this->driver->get($this->url);
    }

    function setInput($id, $value): void
    {
        $element = $this->driver->findElement(WebDriverBy::id($id));
        $element->sendKeys($value);
    }

    function click($id = null, WebDriverBy $by = null): void
    {
        $by = $by ?? WebDriverBy::id($id);

        $element = $this->driver->findElement($by);
        $element->click();
    }
}
