<?php

namespace App\Jobs;

use App\Services\Autopost\AutopostService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class AutoPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $title;
    public string $file;

    public function __construct($title, $file)
    {
        $this->title = $title;
        $this->file = $file;
    }

    public function handle(): void
    {
        try {
            $sleep = 40;
            $service = new AutopostService($this->title, $this->file);

            try {
                $service->instagram();
                sleep($sleep);
            } catch (Throwable $e) {
                print_r("instagram error");
            }

            try {
                $service->threads();
                sleep($sleep);
            } catch (Throwable $e) {
                print_r("Threads error");
            }

            try {
                $service->facebook();
                sleep($sleep);
            } catch (Throwable $e) {
                print_r("facebook error");
            }

            sleep(60);
            $service->driver->driver->quit();
        } catch (Throwable $e) {
            print_r($e->getMessage());
            $service->driver->driver->quit();
        }
    }
}
