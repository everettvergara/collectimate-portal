<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Faker\Factory as Faker;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;

class RaffleEntrySimExport implements FromCollection
{
    public function collection()
    {
        $hash = config('services.encryption.key');
        $faker = Faker::create();
        $data = collect();

        for ($i = 0; $i < 20000; $i++) {
            $data->push([
                'entry_no' => "BTJ{$i}|{$faker->name}|\"{$faker->address}\"|\"{$faker->phoneNumber}\"|{$faker->city}|{$faker->state}|Luzon",
                'no' => 1,
            ]);
        }

        foreach ($data as $row) {
            $line = "{$row['entry_no']},{$row['no']}";
            $hash = hash('sha256', $line . $hash);
        }

        $data->push((object)[
            'entry_no' => 'HASHED:' . $hash,
            'no' => null,
        ]);
        return $data;
    }

    public function map($row): array
    {
        return [
            $row->entry_no,
            $row->no,
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
