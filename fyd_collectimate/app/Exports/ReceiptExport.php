<?php

namespace App\Exports;

use App\Models\tb_raffle_tr_receipt;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\DB;

class ReceiptExport implements FromQuery, WithMapping, WithHeadings, WithChunkReading
{
    protected $date_from;
    protected $date_to;

    public function __construct($date_from, $date_to)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    public function query()
    {
        $date_from = $this->date_from;
        $date_to = $this->date_to;
        return tb_raffle_tr_receipt::select(
            'a.id',
            'a.receipt_date',
            'a.or_no',
            'a.or_date',
            'ab.name as branch',
            'a.total_amount',
            'a.first_name',
            'a.last_name',
            'a.email',
            'a.mobile_no',
            'a.address',
            'ac.island_group',
            'ac.name as province',
            'ad.name as city',
            'ae.name as brg',
            'a.zip',
        )
            ->selectSub(function ($query) {
                $query->from('tb_raffle_tr_receipt_entry as b')
                    ->selectRaw('GROUP_CONCAT(CONCAT("\'", b.entry_no, "\'") ORDER BY b.entry_no SEPARATOR ",")')
                    ->whereColumn('b.receipt_id', 'a.id');
            }, 'entry_no')
            ->addSelect(
                DB::raw("
                CASE
                    WHEN c.attachment IS NOT NULL
                    THEN CONCAT('" . asset('storage/attachments/receipt/') . "/', c.attachment)
                    ELSE NULL
                END AS attachment_url
            ")
            )
            ->from('tb_raffle_tr_receipt as a')
            ->join('tb_raffle_mf_branch as ab', 'ab.id', 'a.branch_id')
            ->join('tb_re_mf_province as ac', 'ac.id', 'a.province_id')
            ->join('tb_re_mf_city as ad', 'ad.id', 'a.city_id')
            ->join('tb_re_mf_brg as ae', 'ae.id', 'a.brg_id')
            ->leftJoin('tb_raffle_tr_receipt_attachment as c', 'c.receipt_id', 'a.id')
            ->when(isset($date_from) && isset($date_to), function ($q) use ($date_from, $date_to) {
                return $q->whereRaw("CAST(a.receipt_date as date) between '" . $date_from . "' and '" . $date_to . "'");
            })
            ->orderBy('a.id', 'asc');
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->receipt_date,
            $row->or_no,
            $row->or_date,
            $row->branch,
            $row->total_amount,
            // encrypt_text($row->first_name),
            // encrypt_text($row->last_name),
            // encrypt_text($row->email),
            // encrypt_text($row->mobile_no),
            // encrypt_text($row->address),
            $row->first_name,
            $row->last_name,
            $row->email,
            $row->mobile_no,
            $row->address,

            $row->island_group,
            $row->province,
            $row->city,
            $row->brg,
            $row->zip,
            $row->entry_no,
            $row->attachment_url,
        ];
    }

    public function headings(): array
    {
        return [
            'RECEIPT ID',
            'RECEIPT DATE',
            'OR NO',
            'OR DATE',
            'BRANCH',
            'TOTAL AMOUNT',
            'FIRST NAME',
            'LAST NAME',
            'EMAIL',
            'MOBILE NO',
            'ADDRESS',
            'ISLAND GROUP',
            'PROVINCE',
            'CITY',
            'BARANGAY',
            'ZIP',
            'ENTRY NO',
            'URL'
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
