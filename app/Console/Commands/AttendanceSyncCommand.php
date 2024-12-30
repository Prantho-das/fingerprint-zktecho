<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Services\FingerPrintMachineService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AttendanceSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:attendance-sync-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync attendance from external API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Attendance sync started');
        $attendances = FingerPrintMachineService::getUserAttendance();
        foreach ($attendances as $attendance) {
            // loading effect
            $this->output->write('.');
            // End loading effect
            $timestamp = Carbon::parse($attendance['timestamp']);
            $date = $timestamp->format('Y-m-d'); // Date part
            $time = $timestamp->format('H:i:s'); // Time part
            $attendances_by = 'Fingerprint';
            switch ($attendance['state']) {
                case 1:
                    $attendances_by = 'Fingerprint';
                    break;
                default:
                    $attendances_by = 'Card';
                    break;
            }
            Attendance::updateOrCreate([
                'user_id' => $attendance['user_id'],
                'date' => $date,
                'time' => $time,
            ], [
                'machine_id' => $attendance['uid'], // Update the machine ID
                'attendance_type' => $attendance['type'], // Attendance type (255 or others)
                'time' => $time,
                'attendances_by' => $attendances_by
            ]);
        }
        $this->info('Attendance sync completed');
    }
}
