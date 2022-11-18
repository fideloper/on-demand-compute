<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetLatestReleaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-release {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the latest release for a project';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = sprintf("https://api.github.com/repos/%s/releases/latest", $this->argument('repo'));

        $response = Http::get($url);

        if ($response->successful()) {
            $tag = $response->json('tag_name');

            // Do something fun extremely useful with $tag
            Log::info("The latest tag is $tag");
        } else {
            Log::error("Could not retrieve repository release", [
                'url' => $url,
                'repo' => $this->argument('repo'),
                'status' => $response->status(),
                'body' =>  $response->body(),
            ]);
        }

        return Command::SUCCESS;
    }
}
