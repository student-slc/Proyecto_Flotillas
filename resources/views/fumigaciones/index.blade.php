@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigaciones.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Cliente</th>
                                    <th style="color:#fff;">Fumigador</th>
                                    <th style="color:#fff;">Fecha programada</th>
                                    <th style="color:#fff;">Fecha ultima fumigacion</th>
                                    <th style="color:#fff;">Lugar</th>
                                    <th style="color:#fff;">No. de visistas</th>
                                    <th style="color:#fff;">Costo</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Satisfaccion del servicio</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($fumigaciones as $fumigacione)
                                        <tr>
                                            <td style="display: none;">{{ $fumigacione->id }}</td>
                                            <td>{{ $fumigacione->id_cliente }}</td>
                                            <td>{{ $fumigacione->id_fumigador }}</td>
                                            <td>{{ $fumigacione->fechaprogramada }}</td>
                                            <td>{{ $fumigacione->fechaultimafumigacion }}</td>
                                            <td>{{ $fumigacione->lugardelservicio }}</td>
                                            <td>{{ $fumigacione->numerodevisitas }}</td>
                                            <td>{{ $fumigacione->costo }}</td>
                                            <td>
                                                @if ($fumigacione->status == 'En Proceso')
                                                    <h5><span class="badge badge-warning">{{ $fumigacione->status }}</span>
                                                    </h5>
                                                @endif
                                                @if ($fumigacione->status == 'Concluido')
                                                    <h5><span class="badge badge-success">{{ $fumigacione->status }}</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>{{ $fumigacione->satisfaccionservicio }}</td>
                                            <td>
                                                <form action="{{ route('fumigaciones.destroy', $fumigacione->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('fumigaciones.edit', $fumigacione->id) }}">
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
                                {!! $fumigaciones->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
