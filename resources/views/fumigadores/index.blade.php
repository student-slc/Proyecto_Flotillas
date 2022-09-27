@extends('layouts.app')
@section('title')
    Fumigadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Fumigadores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('fumigadores.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Fecha Nacimiento</th>
                                    <th style="color:#fff;">Certificado</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($fumigadores as $fumigadore)
                                        <tr>
                                            <td style="display: none;">{{ $fumigadore->id }}</td>
                                            <td>{{ $fumigadore->nombrecompleto }}</td>
                                            <td>{{ $fumigadore->fechanacimiento }}</td>
                                            <td>
                                                @if ($fumigadore->certificacion == 'No')
                                                    <h5><span
                                                            class="badge badge-danger">{{ $fumigadore->certificacion }}</span>
                                                    </h5>
                                                @endif
                                                @if ($fumigadore->certificacion == 'Si')
                                                    <h5><span
                                                            class="badge badge-success">{{ $fumigadore->certificacion }}</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('fumigadores.destroy', $fumigadore->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('fumigadores.edit', $fumigadore->id) }}">
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
                                {!! $fumigadores->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
