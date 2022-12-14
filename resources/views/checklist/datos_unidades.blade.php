@php
    $cliente = $_POST['datos_unidad'];
    $cadena_1 = '<label class="label" for="id_unidad">UNIDADES</label>
        <select name="id_unidad" id="id_unidad" readonly="readonly" class=" selectsearch">
        <option disabled selected value="">SELECCIONA UNA UNIDAD</option>';
    use App\Models\Unidade;
    $unidades = Unidade::where('cliente', '=', $cliente)
        ->where('tipo', '=', 'Unidad Vehicular')
        ->get();
    foreach ($unidades as $unidade) {
        $cadena_1 = $cadena_1 . '<option value=' . $unidade->serieunidad . '> ' . $unidade->serieunidad . '</option>';
    }
    $cadena_1 = $cadena_1 . '</select>';
    echo $cadena_1;
@endphp
