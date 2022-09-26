@extends('layouts.app')
@section('title')
Unidades
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Unidades</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('unidades.create') }}">Nuevo</a>
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
                                    <form action="{{ route('unidades.destroy',$unidade->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('unidades.edit',$unidade->id) }}">
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
