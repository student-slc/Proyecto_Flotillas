@php
    $cliente = strval($_POST['datos_unidad']);
    $cadena_1 = '<label for="filtrooper">Filtro Operadores</label>
        <select name="filtrooper" id="filtrooper" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" style="width:90%">';
    use App\Models\Operadore;
    $operadores = Operadore::where('cliente', '=', $cliente)->get();
    if ($cliente == 'todos') {
        $cadena_1 = $cadena_1 . '<option selected value="todos">Todos Los Operadores</option>';
    } else {
        $cadena_1 = $cadena_1 . '<option value="todos">Todos Los Operadores</option>';
        foreach ($operadores as $operadore) {
            $cadena_1 = $cadena_1 . '<option value="' . strval($operadore->nombreoperador) . '">' . strval($operadore->nombreoperador) . '</option>';
        }
    }
    $cadena_1 = $cadena_1 . '</select>';
    echo $cadena_1;
@endphp
