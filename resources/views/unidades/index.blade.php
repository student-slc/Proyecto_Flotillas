@extends('layouts.app')
@section('title')
    Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Unidades de {{ $usuario }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('unidades.crear', $usuario) }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">No. Serie</th>
                                    <th style="color:#fff;">Marca</th>
                                    <th style="color:#fff;">Submarca</th>
                                    <th style="color:#fff;">Año</th>
                                    <th style="color:#fff;">Tipo</th>
                                    <th style="color:#fff;">Razon social</th>
                                    <th style="color:#fff;">Placas</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Seguro</th>
                                    <th style="color:#fff;">Verificación</th>
                                    <th style="color:#fff;">Mantenimiento</th>
                                    <th style="color:#fff;">Operador</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($unidades as $unidade)
                                        <tr>
                                            <td style="display: none;">{{ $unidade->id }}</td>
                                            <td>{{ $unidade->serieunidad }}</td>
                                            <td>{{ $unidade->marca }}</td>
                                            <td>{{ $unidade->submarca }}</td>
                                            <td>{{ $unidade->añounidad }}</td>
                                            <td>{{ $unidade->tipounidad }}</td>
                                            <td>{{ $unidade->razonsocialunidad }}</td>
                                            <td>{{ $unidade->placas }}</td>
                                            <td>{{ $unidade->status }}</td>
                                            <td>
                                                @if ($unidade->seguro == 'Sin Seguro')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->seguro }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->seguro == 'Con Seguro')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidad = $unidade->serieunidad) }}">{{ $unidade->seguro }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($unidade->verificacion == 'Sin Verificación')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->verificacion }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->verificacion == 'Con Verificación')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->verificacion }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($unidade->mantenimiento == 'Sin Mantenimiento')
                                                    <h5><span class="badge badge-danger"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->mantenimiento }}</a></span>
                                                    </h5>
                                                @endif
                                                @if ($unidade->mantenimiento == 'Con Mantenimiento')
                                                    <h5><span class="badge badge-success"><a class="link-light"
                                                                href="{{ route('unidades.show', $unidade->id) }}">{{ $unidade->mantenimiento }}</a></span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($unidade->operador == 0)
                                                   {{--  <a class="btn btn-danger"
                                                        href="{{ route('operadores.show', $unidad = $unidade->serieunidad) }}">
                                                        <i class="fas fa-id-card"></i></a> --}}
                                                        <h5><span class="badge badge-danger"><a class="link-light"
                                                            href="{{ route('operadores.show', $unidad = $unidade->serieunidad) }}">Sin Operador</a></span>
                                                </h5>
                                                @else
                                                   {{--  <a class="btn btn-success"
                                                        href="{{ route('operadores.show', $unidad = $unidade->serieunidad) }}">
                                                        <i class="fas fa-id-card"></i></a> --}}
                                                        <h5><span class="badge badge-success"><a class="link-light"
                                                            href="{{ route('operadores.show', $unidad = $unidade->serieunidad) }}">Con Operador</a></span>
                                                </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('unidades.destroy', $unidade->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('unidades.edit', $unidade->id) }}">
                                                        <i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $unidades->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
