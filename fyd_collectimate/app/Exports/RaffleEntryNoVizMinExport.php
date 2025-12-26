<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\tb_raffle_tr_receipt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;

class RaffleEntryNoVizMinExport implements FromCollection, WithMapping, WithChunkReading
{
    public function collection()
    {
        $secret = config('services.encryption.key');

        $data = tb_raffle_tr_receipt::select(
            'b.entry_no',
            DB::raw("CONCAT(a.first_name, ' ', a.last_name, '|', '\"', a.address, '\"', '|', '\"', a.mobile_no, '\"', '|', ad.name, '|', ac.name, '|', ac.island_group) as additional_data"),
            DB::raw('1 as no')
        )
            ->from('tb_raffle_tr_receipt as a')
            ->join('tb_raffle_mf_branch as ab', 'ab.id', 'a.branch_id')
            ->join('tb_re_mf_province as ac', 'ac.id', 'a.province_id')
            ->join('tb_re_mf_city as ad', 'ad.id', 'a.city_id')
            ->join('tb_re_mf_brg as ae', 'ae.id', 'a.brg_id')
            ->join('tb_raffle_tr_receipt_entry as b', 'b.receipt_id', 'a.id')
            ->whereRaw("CAST(a.receipt_date as date) between '2025-7-16' and '2025-10-15'")
            ->whereNot('ac.island_group', 'Luzon')
            ->get();

        // Compute hash across rows
        $hash = $secret;
        foreach ($data as $row) {
            $line = "{$row->entry_no}|{$row->additional_data}";
            $hash = hash('sha256', $line . $hash);
        }

        // Add final hash row
        $data->push((object)[
            'entry_no' => 'HASHED:' . $hash,
            'additional_data' => null,
        ]);

        return $data;
    }

    public function map($row): array
    {
        // Leave HASH row untouched
        if (str_starts_with($row->entry_no, 'HASHED:')) {
            return [$row->entry_no];
        }

        // Ensure 32‑byte key
        // $key = hash('sha256', config('services.encryption.key'), true);
        // $iv = random_bytes(16);

        // $ciphertext = openssl_encrypt(
        //     $row->additional_data,
        //     'AES-256-CBC',
        //     $key,
        //     OPENSSL_RAW_DATA,
        //     $iv
        // );

        // $encryptedBase64 = base64_encode($iv . $ciphertext);

        return [
            // $row->entry_no . '|' . $encryptedBase64,
            $row->entry_no . '|' . $row->additional_data,
            $row->no,
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
