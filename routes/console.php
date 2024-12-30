<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('app:attendance-sync-command', function () {
    $this->info('Attendance Sync Command');
})->purpose('Sync attendance data from machine to database')->everyMinute();
