<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Jobs\StoreBlogPostJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PullPostFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull post feed from external source';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            
            $response = Http::withHeaders(['Accept' => 'application/json'])->get(config('blogger.feed_link'));

            // check if call failed
            if ($response->failed()) {
                $this->info('call failed');
            }

            // get response as json
            $responseInJson = $response->json();

            if ($responseInJson && isset($responseInJson['data'])) {

                // get system created user, admin id
                $adminId = User::where('email', config('blogger.admin.email'))->pluck('id')->first();
                
                DB::beginTransaction();

                foreach($responseInJson['data'] as $key => $data) {

                    StoreBlogPostJob::dispatch($data + ['user_id' => $adminId])
                        ->delay(now()->addSecond(($key + 1) * 10));
                }

                DB::commit();

                $this->info('succesfully pulled blog feed');

            }

        } catch (\Throwable $th) {

            DB::rollBack();
            
            Log::error($th->getMessage(), $th->getTrace());

            $this->error('An error occurred while pulling blog feed');
        }
        // return 0;
    }
}
