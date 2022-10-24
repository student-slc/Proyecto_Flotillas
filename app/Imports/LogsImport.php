<?php

namespace App\Imports;

use App\Models\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash; /* PARA PASSWORDS = 'password' => Hash::make($row['password']), */
class LogsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Log([
            'event' => $row['event'],
            'dato' => $row['dato'],
        ]);
    }
}
