<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function seguros()
    {
        return view('reportes.seguros');
    }
    public function vambiental()
    {
        return view('reportes.vambiental');
    }
    public function vfisicas()
    {
        return view('reportes.vfisicos');
    }
    public function mantenimientos()
    {
        return view('reportes.mantenimiento');
    }
    public function fumigaciones()
    {
        return view('reportes.fumigaciones');
    }
}
