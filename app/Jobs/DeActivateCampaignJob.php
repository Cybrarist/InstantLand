<?php

namespace App\Jobs;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class DeActivateCampaignJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Campaign::where('end_at', today())
            ->update([
                'status' => StatusEnum::Finished
            ]);

        Log::info('campaigns Deactivated for today successfully');
    }
}
