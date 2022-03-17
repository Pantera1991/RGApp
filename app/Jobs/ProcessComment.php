<?php

namespace App\Jobs;

use App\Models\Comment;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Log::info("start creating new comment.");
        $url = config('app.url', 'http://localhost') . '/api/v1/comments';

        try {
            (new Client())->post($url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-type' => 'application/json'
                ],
                RequestOptions::JSON => Comment::factory()->definitionSayYes()
            ]);

            Log::info("success comment created.");

        } catch (GuzzleException|\Exception $e) {
            Log::error("ProcessComment::handle, " . $e->getMessage());
        }
    }
}
