<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Salidas</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
    @include('Intranet/navbar')
    <!-- Contenido principal -->
    <div class="container" style="margin-left: 250px; padding: 20px;">

        <h1 style="text-align: center">Saca materiales a un almacen de {{$ubicacion->nombreu}}</h1>
        <form id="formulario" action="{{ route('RegistrarSalida', $ubicacion->id_ubicacion) }}" method="POST">
            @csrf <!-- Para protección contra ataques CSRF en Laravel -->
            <label for="nombre">Nombre del almacen:</label>
            <select name="id_almacen" id="id_almacen" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;">
                <option value="">-</option>
                @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id_almacen }}">{{ $almacen->nombrea }}</option>
                @endforeach
            </select>
            <label for="nombre">Material</label>
            <select name="id_mat_alm" id="id_mat_alm" style="padding: 10px; margin-bottom: 20px; border: 2px solid #ccc; border-radius: 4px; width: 50%;" required>
        
            </select>
            <label for="cantidad">Cantidad:</label>
            <input class="input" type="number" id="cantidad" name="cantidad" step="0.001" value="{{ old('cantidad') }}" required>
            <label for="suma_cantidad">No puedes superar la siguiente cantidad:</label>
            <input class="input" type="number" id="suma_cantidad" step="0.001" readonly>
            <button id="botonCrearSalida" type="submit" disabled>Crear salida</button>
            <p id="mensajeError" style="color: red;"></p>
        
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: #ffcccc; color: #cc0000; padding: 10px; border-radius: 5px;">
                    <ul style="list-style-type: none; padding: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

</body>
</html>


<script>
    $('#id_almacen').change(function() {
        var selectedAlmacenId = $(this).val();
        var materialSelect = $('#id_mat_alm');
    
        // Limpiar el select de materiales
        materialSelect.empty();
    
        // Agregar primer ítem vacío
        materialSelect.append('<option value="" disabled selected>- Seleccione un material -</option>');
    
        // Verificar si el valor seleccionado del almacén es válido
        if (selectedAlmacenId) {
            // Realizar la solicitud AJAX
            $.get('/obtenerMateriales/' + selectedAlmacenId, function(data) {
                // Llenar el select de materiales con los datos recibidos
                $.each(data, function(index, material) {
                    materialSelect.append('<option  id="id_mat_alm" value="' + material.id_mat_alm + '">' + material.material.nombrema + '</option>');
                });
            });
        }
    });
    
    $('#id_mat_alm').change(function() {
        var idMatAlm = $(this).val();
        
        $.get('/obtenerSumaCantidad/' + idMatAlm, function(response) {
            console.log(response); // Verificar la respuesta en la consola del navegador
            var sumaCantidad = parseFloat(response);
            if (!isNaN(sumaCantidad)) {
                $('#suma_cantidad').val(sumaCantidad.toFixed(3)); // Convertir y establecer el valor en el input
            } else {
                console.error('El valor recibido no es un número válido:', response);
            }
        });
    });

    $(document).ready(function() {
    $('#cantidad').keyup(function() {
        var cantidad = parseFloat($(this).val());
        var sumaCantidad = parseFloat($('#suma_cantidad').val());
        
        console.log("Cantidad:", cantidad);
        console.log("Suma cantidad:", sumaCantidad);

        if (!isNaN(cantidad) && !isNaN(sumaCantidad)) {
            if (cantidad > sumaCantidad) {
                $('#mensajeError').text('La cantidad no puede superar la suma de cantidad.');
                $('#botonCrearSalida').prop('disabled', true);
            } else {
                $('#mensajeError').text('');
                $('#botonCrearSalida').prop('disabled', false);
            }
        }
    });
});
    </script>