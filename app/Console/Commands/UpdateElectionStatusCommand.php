<?php
namespace App\Console\Commands;

use App\Models\Election;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateElectionStatusCommand extends Command
{
    protected $signature = 'elections:update-status';

    protected $description = 'Update the status of elections based on start and end times';

    public function handle()
    {
        $now = Carbon::now();

        Election::chunk(100, function ($elections) use ($now) {
            foreach ($elections as $election) {
                if ($now->gte($election->start) && $now->lt($election->end)) {
                    $election->status = 'active';
                } elseif ($now->gte($election->end)) {
                    $election->status = 'completed';
                }

                $election->save();
            }
        });

        $this->info('Election statuses updated successfully.');
    }
}
