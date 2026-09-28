<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupArchives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-archives';
    protected $description = 'Permanently delete archived records older than 30 days';

    public function handle()
    {
        $cutoffDate = now()->subDays(30);

        \App\Models\Product::onlyTrashed()->where('deleted_at', '<', $cutoffDate)->forceDelete();
        \App\Models\Category::onlyTrashed()->where('deleted_at', '<', $cutoffDate)->forceDelete();
        \App\Models\Order::onlyTrashed()->where('deleted_at', '<', $cutoffDate)->forceDelete();

        $this->info('Archived records older than 30 days have been permanently deleted.');
        return 0;
    }

}
