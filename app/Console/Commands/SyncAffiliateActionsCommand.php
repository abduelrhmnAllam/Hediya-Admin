<?php

namespace App\Console\Commands;

use App\Models\AffiliateNetwork;
use App\Services\Admitad\AdmitadClient;
use App\Services\Admitad\SyncAdmitadActionsJob;
use App\Services\Boostiny\BoostinyClient;
use App\Services\Boostiny\SyncBoostinyCouponActionsJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SyncAffiliateActionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'affiliate:sync {--days=7 : Number of days to look back}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync actions from supported affiliate networks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $from = Carbon::now()->subDays($days)->toDateString();
        $to = Carbon::now()->toDateString();

        $this->info("Starting sync from {$from} to {$to}...");

        $networks = AffiliateNetwork::all();

        foreach ($networks as $network) {
            $this->info("Processing network: {$network->name} ({$network->key})");

            try {
                if ($network->key === 'admitad') {
                    $job = new SyncAdmitadActionsJob([
                        'date_start' => $from,
                        'date_end' => $to,
                    ], $network->id);

                    $job->handle(new AdmitadClient());
                    $this->success("Admitad sync completed.");
                }

                if ($network->key === 'boostiny') {
                    $job = new SyncBoostinyCouponActionsJob($from, $to, $network->id);
                    $job->handle(new BoostinyClient());
                    $this->success("Boostiny sync completed.");
                }

            } catch (\Exception $e) {
                $this->error("Error syncing {$network->name}: " . $e->getMessage());
            }
        }

        $this->info('Affiliate sync finished.');
    }

    protected function success($message)
    {
        $this->line("<fg=green>{$message}</>");
    }
}
