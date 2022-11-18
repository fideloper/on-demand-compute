<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Fly {
    public function __construct(protected string $token) {}

    /**
     * @link https://fly.io/docs/reference/machines/#start-a-machine
     * @param $app
     * @param $machineId
     * @return null
     * @throws \Exception
     */
    public function startMachine($app, $machineId)
    {
        $response = Http::withToken($this->token)
            ->post("https://api.machines.dev/v1/apps/$app/machines/$machineId/start");

        if (! $response->successful()) {
            // Log exception so we can provide additional context
            $e = new \Exception("Fly Machine could not start");

            Log::error($e, [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            throw $e;
        }
    }
}
