@extends('layouts.app')
@section('title')
    REPORTES
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reportes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-deck mt-6">
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_flotilla') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTES FLOTILLA</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_seguros') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTE SEGUROS DE RESP CIVIL</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_veri') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTES VERI VEHICULARES</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-deck mt-6">
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_fumigaciones') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTES FUMIGACIONES</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_semanal') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTE SEMANAL O MENS FUMIGACIONES</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_dia') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTES DEL DIA SERVICIOS (ACUMULADOS)</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-deck mt-6">
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_servicios') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTES DE SERVICIOS DE LA SEMANA (ACUMULADOS)</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_individualv') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTE INDIVIDUAL VEHICULAR</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_individual') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTE INDIVIDUAL OPERADOR</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-deck mt-6">
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_satisfaccion') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        REPORTES DE SATISFACCION SERVICIO FUMIGACION</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_individualv') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        INCONCLUSO</i>
                                </a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center chart-container">
                                <a class="btn btn-dark" style="background-color: rgb(50,50,50);"
                                    href="{{ route('tabla_reportes.reporte_individual') }}">
                                    <i style="font-size: 1rem; color: rgb(255,255,255);">
                                        INCONCLUSO</i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
