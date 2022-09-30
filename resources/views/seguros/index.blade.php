@extends('layouts.app')
@section('title')
    Seguros
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Seguros: {{ $unidad }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('seguros.show',$unidad) }}">Nuevo</a>
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">No. Poliza</th>
                                    <th style="color:#fff;">Serie Unidad</th>
                                    <th style="color:#fff;">Fecha Inicio</th>
                                    <th style="color:#fff;">Fecha de Vencimiento</th>
                                    <th style="color:#fff;">Tipo de Seguro</th>
                                    <th style="color:#fff;">Caratula</th>
                                    <th style="color:#fff;">Proveedor</th>
                                    <th style="color:#fff;">Precio</th>
                                    <th style="color:#fff;">Impuestos</th>
                                    <th style="color:#fff;">Costo Total</th>
                                    <th style="color:#fff;">Status</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($seguros as $seguro)
                                        <tr>
                                            <td style="display: none;">{{ $seguro->id }}</td>
                                            <td>{{ $seguro->nopoliza }}</td>
                                            <td>{{ $seguro->id_unidad }}</td>
                                            <td>{{ $seguro->fechainicio }}</td>
                                            <td>{{ $seguro->fechavencimiento }}</td>
                                            <td>{{ $seguro->tiposeguro }}</td>
                                            <td>{{ $seguro->caratulaseguro }}</td>
                                            <td>{{ $seguro->provedor }}</td>
                                            <td>{{ $seguro->precio }}</td>
                                            <td>{{ $seguro->impuestos }}</td>
                                            <td>{{ $seguro->costototal }}</td>
                                            <td>
                                                <h5><span class="badge badge-success">Activo</span>
                                                </h5>
                                            </td>
                                            <td>
                                                <form action="{{ route('seguros.destroy', $seguro->id,$unidad) }}" method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('seguros.edit', $seguro->id) }}">
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
                                {!! $seguros->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
