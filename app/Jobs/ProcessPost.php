<?php

namespace App\Jobs;

use App\Models\Post;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info("start creating post.");
        $url = config('app.url', 'http://localhost') . '/api/v1/posts';

        try {
            (new Client())->post($url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                RequestOptions::JSON => Post::factory()->definition()
            ]);

            Log::info("success post created.");

        } catch (GuzzleException $e) {
            Log::error("ProcessPost::handle, " . $e->getMessage());
        }
    }

}
