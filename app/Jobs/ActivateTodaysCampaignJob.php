<?php

namespace App\Jobs;

use App\Enums\StatusEnum;
use App\Models\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ActivateTodaysCampaignJob implements ShouldQueue
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
        Campaign::whereDate('start_at', today())
            ->update([
                'status' => StatusEnum::Active
            ]);



        Log::info('campaigns activated for today successfully');
    }
}
