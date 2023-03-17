@php
    $cliente = strval($_POST['datos_unidad']);
    $cadena_1 = '<label for="filtrounid">Filtro Unidades</label>
        <select name="filtrounid" id="filtrounid" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" style="width:90%">';
    use App\Models\Unidade;
    $unidad = Unidade::where('cliente', '=', $cliente)
        ->where('tipo', '=', 'Unidad Vehicular')
        ->get();
    if ($cliente == 'todos') {
        $cadena_1 = $cadena_1 . '<option selected value="todos">Todas Las Unidades</option>';
    } else {
        $cadena_1 = $cadena_1 . '<option value="todos">Todas Las Unidades</option>';
        foreach ($unidad as $unidade) {
            $cadena_1 = $cadena_1 . '<option value="' . strval($unidade->placas) . '">' . strval($unidade->placas) . '</option>';
        }
    }
    $cadena_1 = $cadena_1 . '</select>';
    echo $cadena_1;
@endphp
