@extends('layouts.app')
@section('title')
    Clientes
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Clientes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('clientes.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre Cliente</th>
                                    <th style="color:#fff;">Razon Social</th>
                                    <th style="color:#fff;">Telefono</th>
                                    <th style="color:#fff;">Direccion</th>
                                    <th style="color:#fff;">Correo</th>
                                    <th style="color:#fff;">Unidades</th>
                                    <th style="color:#fff;">Status de Servicio</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td style="display: none;">{{ $cliente->id }}</td>
                                            <td>{{ $cliente->nombrecompleto }}</td>
                                            <td>{{ $cliente->razonsocial }}</td>
                                            <td>{{ $cliente->telefono }}</td>
                                            <td>{{ $cliente->direccionfisica }}</td>
                                            <td>{{ $cliente->correo }}</td>
                                            <td>
                                                <a class="btn btn-dark"  href="{{ route('clientes.show', $usuario= $cliente->nombrecompleto) }}">
                                                    <i class="fas fa-bus"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($cliente->statuspago == 'Sin Servicio')
                                                    <h5><span class="badge badge-dark">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'Por Confirmar')
                                                    <h5><span class="badge badge-warning">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'En Ejecucion')
                                                    <h5><span class="badge badge-primary">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'No Pagado')
                                                    <h5><span class="badge badge-danger">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                                @if ($cliente->statuspago == 'Pagado')
                                                    <h5><span class="badge badge-success">{{ $cliente->statuspago }}</span>
                                                    </h5>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('clientes.edit', $cliente->id) }}">
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
                                {!! $clientes->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
