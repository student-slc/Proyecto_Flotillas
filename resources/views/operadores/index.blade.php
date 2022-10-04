@extends('layouts.app')
@section('title')
Operadores
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Operadores de : {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="card-body">
                    <a class="btn btn-danger" href="{{ route('clientes.show', $usuario=$unidad) }}">Regresar</a>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($numero==0)
                            <a class="btn btn-warning" href="{{ route('operadores.crear',$unidad) }}">Nuevo</a>
                            @endif
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Operador</th>
                                    <th style="color:#fff;">Fecha Nacimiento</th>
                                    <th style="color:#fff;">No. Licencia</th>
                                    <th style="color:#fff;">Tipo Licencia</th>
                                    <th style="color:#fff;">Fecha de Vencimiento Medico</th>
                                    <th style="color:#fff;">Fecha de Vencimiento Licencia</th>
                                    <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                            @foreach ($operadores as $operadore)
                            <tr>
                                <td style="display: none;">{{ $operadore->id }}</td>
                                <td>{{ $operadore->nombreoperador }}</td>
                                <td>{{ $operadore->fechanacimiento }}</td>
                                <td>{{ $operadore->nolicencia }}</td>
                                <td>{{ $operadore->tipolicencia }}</td>
                                <td>{{ $operadore->fechavencimientomedico }}</td>
                                <td>{{ $operadore->fechavencimientolicencia }}</td>
                                <td>
                                    <form action="{{ route('operadores.destroy',$operadore->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('operadores.edit',$operadore->id) }}">
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
                            {!! $operadores->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
