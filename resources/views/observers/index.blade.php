@extends('layouts.app')
@section('title')
    Logs
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Logs</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{-- IMPORTAR EXCEL --}}
                        {{-- <div class="form-group">
                            <form action="{{ route('log.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="form-control">
                                <br>
                                <button class="btn btn-warning"><i class="fas fa-file-excel"></i></button>
                            </form>
                        </div> --}}
                        <div class="card-body">
                            <table class="table table-striped mt-2" id="tabla">
                                <a class="btn btn-success" href="{{ route('logs.export') }}"><i
                                        class="fas fa-file-excel"></i></a>
                                <input type="text" class="form-control pull-right" style="width:20%" id="search"
                                    placeholder="Buscar....">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Actividad</th>
                                    <th style="color:#fff;">Datos</th>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td style="display: none;">{{ $log->id }}</td>
                                            <td>{{ $log->event }}</td>
                                            <td>{{ $log->dato }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Ubicamos la paginacion a la derecha -->
                            {{--  <div class="pagination justify-content-end">
                                {!! $logs->links() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
