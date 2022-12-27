@extends('layouts.app')
@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('title')
    REPORTE PREVENTIVO
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reporte Preventivo Vehicular</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id='tablas-style' class="table table-striped mt-2" id="tabla">
                                <a class="btn btn-success"{{--  href="{{ route('unidades.export', $usuario) }}" --}}><i class="fas fa-file-excel"></i></a>
                                {{-- <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar...."> --}}
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Placas</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Serie Unidad</th>
                                    <th style="color:#fff;">Marca</th>
                                    <th style="color:#fff;">Año Unidad</th>
                                    <th style="color:#fff;">Tipo Unidad</th>
                                    <th style="color:#fff;">Razon Social</th>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 'a';
                                        use App\Models\Verificacione;
                                        $verificaciones = Verificacione::all();
                                    @endphp
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td>{{ $unidade->placas }}</td>
                                            <td>{{ $unidade->cliente }}</td>
                                            <td>{{ $unidade->serieunidad }}</td>
                                            <td>{{ $unidade->marca }}</td>
                                            <td>{{ $unidade->añounidad }}</td>
                                            <td>{{ $unidade->tipounidad }}</td>
                                            <td>{{ $unidade->razonsocialunidad }}</td>
                                            {{-- Boton MODAL --}}
                                            {{-- AQUI VA --}}

                                            {{--  --}}
                                        </tr>
                                        @php
                                            $a = $a . 'a';
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{--  <div class="pagination justify-content-end">
                                {!! $unidades->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#tablas-style').DataTable();
        });
    </script>
@endsection
