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
    public string|null $url;
    public Webdriver $driver;

    public string|null $title;

    public string|null $file;
    public int $sleep;


    function fixUnicode($text): string
    {
        $text = strip_tags($text);
        $fixedText = '';
        for ($i = 0; $i < mb_strlen($text, 'UTF-8'); $i++) {
            $char = mb_substr($text, $i, 1, 'UTF-8');

            if (strlen($char) > 1) {
                $fixedText .= "";
            } else {
                $fixedText .= $char;
            }
        }

        return $fixedText;
    }

    public function __construct($title, $file, $url = null)
    {
        $this->title = $this->fixUnicode($title);

        $file_path = storage_path("app/posts/image.jpg");
        file_put_contents($file_path, file_get_contents($file));
        $this->file = $file_path;


        $this->sleep = 5;
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
            sleep($this->sleep);
            $driver->click(by: WebDriverBy::xpath('/html/body/div[2]/div/div/div[2]/div/div/div[1]/div[1]/div[1]/div/div/div/div/div[2]/div[7]/div/span/div/a'));
            sleep($this->sleep);
            $el = $driver->driver->findElement(WebDriverBy::xpath("//input[@class='_ac69']"));
            $el->sendKeys($this->file);
            sleep($this->sleep);
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));
            sleep($this->sleep);
            $driver->click(by: WebDriverBy::xpath("//div[contains(@class,'x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xyamay9 x1pi30zi x1l90r2v x1swvt13 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1')]"));
            sleep($this->sleep);
            $driver->driver->findElement(WebDriverBy::xpath("//div[@data-lexical-editor='true']"))->sendKeys($this->title);
            sleep($this->sleep);
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
            sleep($this->sleep);
            $driver->click(by: WebDriverBy::xpath("/html/body/div[1]/div/div[1]/div/div[2]/div[5]/div[2]/div/div/div[1]/div[1]/div/div/div/div/div/div[2]/div[1]/div/div/div[2]/div[2]/div/div/div[2]/div[1]"));
            sleep($this->sleep);
            $driver->driver->findElement(WebDriverBy::xpath("/html/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[1]/div[1]/div/div/div[1]/p"))->sendKeys($this->title);
            sleep($this->sleep);
            $driver->click(by: WebDriverBy::xpath("/html/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[3]/div[1]"));
            sleep($this->sleep);
            $driver->driver->findElement(WebDriverBy::xpath('//*[@id="facebook"]/body/div[5]/div[1]/div/div[2]/div/div/div/form/div/div[1]/div/div/div/div[2]/div[1]/div[2]/div/div[1]/div/div/input'))->sendKeys($this->file);
            sleep($this->sleep);
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
            sleep($this->sleep);

            try {
                $driver->driver->findElement(WebDriverBy::xpath("//div[@data-lexical-editor='true']"))->sendKeys($this->title);
                sleep($this->sleep);
            } catch (Throwable $e) {
                print_r($e->getMessage());
            }

            try {
                $driver->driver->findElement(WebDriverBy::xpath("//input[@type='file']"))->sendKeys($this->file);
                sleep($this->sleep);
            } catch (Throwable $e) {
                print_r($e->getMessage());
            }

            $driver->driver->findElement(WebDriverBy::xpath("/html/body/div[4]/div[1]/div/div[2]/div/div/div/div[2]/div/div/div/div[2]/div/div[2]/div/div[1]/div"))->click();
            return true;
        } catch (Throwable $exception) {
            Helpers::log($exception->getMessage());
            return false;
        }
    }

    /**
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    #[NoReturn] public function telegram($chat_id): bool
    {
        $token = Env::get("BOT_TOKEN");
        $bot = new Nutgram($token);
        $bot->sendPhoto(photo: InputFile::make(fopen($this->file, "rb")), chat_id: $chat_id, caption: $this->title);
        return true;
    }
}

