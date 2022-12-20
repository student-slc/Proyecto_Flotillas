@php
    $cliente =  strval($_POST['datos_operador']);
    $cadena_2 = '<label class="label" for="id_operador">OPERADORES</label>
        <select name="id_operador" id="id_operador" readonly="readonly" class=" selectsearch">
        <option disabled selected value="">SELECCIONA UN OPERADOR</option>';
    use App\Models\Operadore;
    $operadores = Operadore::where('cliente', '=', $cliente)->get();
    foreach ($operadores as $operadore) {
        $cadena_2 = $cadena_2 . '<option value="' . $operadore->id . '">' . strval($operadore->nombreoperador) . '</option>';
    }
    $cadena_2 = $cadena_2 . '</select>';
    echo $cadena_2;
@endphp
