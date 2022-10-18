<?php

namespace App\Http\Controllers;

use App\Exports\LogsExport;
use App\Imports\LogsImport;
use App\Models\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ExcelLogController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new LogsExport, 'Log.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        Excel::import(new LogsImport,request()->file('file'));
        return back();
    }
}
