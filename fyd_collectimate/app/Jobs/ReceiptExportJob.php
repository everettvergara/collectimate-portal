<?php

namespace App\Jobs;

use App\Exports\RaffleEntryNoLuzonExport;
use App\Exports\ReceiptExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReceiptExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date_from;
    protected $date_to;

    public function __construct($date_from, $date_to)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        // Excel::store(new ReceiptExport($date_from, $date_to), 'exports/botejyu_receipt_entry_no_' . now()->toDateTimeString() . '.xlsx');

        $date = now()->format('Y-m-d_H-i-s');
        try {
            $success = Excel::store(new ReceiptExport($date_from, $date_to), 'exports/botejyu_receipt_entry_no_' . $date . '.xlsx');
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
