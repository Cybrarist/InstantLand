<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
        \App\Jobs\ActivateTodaysCampaignJob::dispatch();
        \App\Jobs\DeActivateCampaignJob::dispatch();
})->dailyAt('00:01');

