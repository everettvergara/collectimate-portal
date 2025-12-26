<?php

namespace App\Exports;

use App\Models\tb_raffle_tr_receipt_fail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ReceiptFailedExport implements FromCollection, WithMapping, WithHeadings, WithChunkReading
{
    protected $date_from;
    protected $date_to;
    protected $no_duplicates;

    public function __construct($date_from, $date_to, $no_duplicates)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
        $this->no_duplicates = $no_duplicates;
    }

    public function collection()
    {
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        $no_duplicates = $this->no_duplicates;

        return tb_raffle_tr_receipt_fail::select(
            'a.id',
            'a.receipt_date',
            'ab.name as branch',
            'a.first_name',
            'a.last_name',
            'a.email',
            'a.mobile_no',
            'a.address',
            'ac.name as province',
            'ad.name as city',
            'ae.name as brg',
            'a.zip',
            'a.remarks',
            'a.raw',
            DB::raw("
                CASE
                    WHEN c.attachment IS NOT NULL
                    THEN CONCAT('" . asset('storage/attachments/receipt/') . "/', c.attachment)
                    ELSE NULL
                END AS attachment_url
            ")
        )
            ->from('tb_raffle_tr_receipt_fail as a')
            ->join('tb_raffle_mf_branch as ab', 'ab.id', 'a.branch_id')
            ->join('tb_re_mf_province as ac', 'ac.id', 'a.province_id')
            ->join('tb_re_mf_city as ad', 'ad.id', 'a.city_id')
            ->join('tb_re_mf_brg as ae', 'ae.id', 'a.brg_id')
            ->leftJoin('tb_raffle_tr_receipt_fail_attachment as c', 'c.receipt_id', 'a.id')
            ->when(isset($date_from) && isset($date_to), function ($q) use ($date_from, $date_to) {
                return $q->whereRaw("CAST(a.receipt_date as date) between '" . $date_from . "' and '" . $date_to . "'");
            })
            ->when($no_duplicates == 1, function ($q) {
                return $q->where('a.remarks', '!=', "Duplicate entry of receipt.")
                    ->whereRaw("NOT EXISTS (SELECT * FROM tb_raffle_tr_receipt as x where x.branch_id = a.branch_id and
                    x.or_no = a.or_no
                )")
                ;
            })
            ->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->receipt_date,
            $row->branch,
            encrypt_text($row->first_name),
            encrypt_text($row->last_name),
            encrypt_text($row->email),
            encrypt_text($row->mobile_no),
            encrypt_text($row->address),
            $row->province,
            $row->city,
            $row->brg,
            $row->zip,
            $row->remarks,
            $row->raw,
            $row->attachment_url,
        ];
    }

    public function headings(): array
    {
        return [
            'RECEIPT ID',
            'RECEIPT DATE',
            'BRANCH',
            'FIRST NAME',
            'LAST NAME',
            'EMAIL',
            'MOBILE NO',
            'ADDRESS',
            'PROVINCE',
            'CITY',
            'BARANGAY',
            'ZIP',
            'REMARKS',
            'RAW',
            'URL',
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
