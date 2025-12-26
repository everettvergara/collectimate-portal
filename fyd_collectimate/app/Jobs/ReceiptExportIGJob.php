<?php

namespace App\Jobs;

use App\Exports\RaffleEntryNoLuzonExport;
use App\Exports\ReceiptExport;
use App\Exports\ReceiptExportIG;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptExportIGJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $island_group;

    public function __construct($island_group)
    {
        $this->island_group = $island_group;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $island_group = $this->island_group;
        // Excel::store(new ReceiptExport($date_from, $date_to), 'exports/botejyu_receipt_entry_no_' . now()->toDateTimeString() . '.xlsx');
        $ig = ($island_group === 'Luzon') ? 'luzon' : 'vizmin';
        $date = now()->format('Y-m-d_H-i-s');
        try {
            $success = Excel::store(new ReceiptExportIG($island_group), 'exports/botejyu_receipt_' . $ig . '_' . $date . '.xlsx');
            if ($success) {
                Log::info('Export stored successfully.');
            } else {
                Log::warning('Export failed silently.');
            }
        } catch (\Exception $e) {
            Log::error('Export error: ' . $e->getMessage());
        }
    }
}
