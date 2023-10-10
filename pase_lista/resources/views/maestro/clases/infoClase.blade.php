@extends('layouts.app2')

@section('titulo')
    Editar Asistencias
@endsection
<!-- Agrega el elemento a la stack en app.blade.php -->
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')

@foreach ($clases as $clase)
<br>
<div class="relative w-full mx-auto mt-500">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
                <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                    <img src="{{ asset('img/maestro/info.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                    <h5 class="mb-1 dark:text-black">{{ $clase->materia}}</h5>
                    <p class="mb-0 font-semibold leading-normal dark:text-black dark:opacity-60 text-sm">Horario: {{ $clase->dia}} , {{$clase->hora_inicio }} - {{ $clase->hora_fin}}</p>
                    <p class="mb-0 font-semibold leading-normal dark:text-black dark:opacity-60 text-sm">Grupo: {{$clase->grupo}},  Aula: {{$clase->aula }}</p>
                </div>
            </div>

            <div class="p-4 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent" style=" margin-left: 40%;">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex items-center flex-none max-w-full px-3">
                        <!-- div vacío -->
                    </div>
                    <div class="max-w-full px-3 text-right mt-auto">
                        <a href="{{ route('maestros.asistencias', ['clase' => $clase->id ]) }}" class="inline-block px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md bg-150 bg-blue-500  hover:shadow-xs hover:-translate-y-px tracking-tight-rem bg-x-25">
                            <i class="fas fa-edit" aria-hidden="true"></i> Editar Asistencias
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">

        <div class="w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <div class="flex items-center">
                        <p class="mb-0 dark:text-black/80">Gráfica</p>
                    </div>

                    <form action="{{ route('maestros.fechas') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="fecha_inicio" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Fecha de Inicio</label>
                            <select name="fecha_inicio" id="fecha_inicio">
                                <option value="">Seleccione una fecha de inicio</option>
                                @foreach ($fechasAsistencia as $fecha)
                                    <option value="{{ $fecha }}">{{ $fecha }}</option>
                                @endforeach
                            </select>
                            <label for="fecha_inicio" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Fecha de Termino</label>
                            <select name="fecha_fin" id="fecha_fin">
                                <option value="">Seleccione una fecha de fin</option>
                                @foreach ($fechasAsistencia as $fecha)
                                    <option value="{{ $fecha }}">{{ $fecha }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="selectedClass" id="selectedClass" value="{{$clase->id}}">
                        </div>
                        {{-- <div class="mb-4">
                            <label for="fecha_fin" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Fecha de Fin</label>
                            <select name="fecha_fin" id="fecha_fin" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                <option value="">Seleccione una fecha de fin</option>
                                @foreach ($fechasAsistencia as $fecha)
                                    <option value="{{ $fecha }}">{{ $fecha }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <button type="submit" id="fechas" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Ir</button>
                    </form>

                    <div id="graficaPastelContainer" style="width: 40%; height: 40%;">
                        <canvas id="graficaPastel"></canvas>
                    
                    </div>
                </div>

                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <div class="flex items-center">
                        <p class="mb-0 dark:text-black/80">Gráficas por alumno</p>
                    </div>
                    <canvas class="xd"  id="graficaAsistencias"  style="width: 300px; height: 100px;"></canvas>
                </div>
                <br>
                
            </div>
            
        </div>

    </div>
    @endforeach

    <footer class="pt-4">
            <div class="w-full px-6 mx-auto">
                <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                    <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                        <div class="text-sm leading-normal text-center text-white lg:text-left">
                            ©
                            <script>
                                document.write(new Date().getFullYear() + ",");
                            </script>
                            made with <i class="fa fa-heart"></i> by WiTech
                        </div>
                    </div>
                </div>
            </div>
        </footer>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // Obtener el elemento select y el enlace
    const selectClase = document.getElementById('claseClase');
    const enlaceClase = document.getElementById('enlaceClase');

    // Escuchar cambios en el select
    selectClase.addEventListener('change', function() {
        // Obtener el valor seleccionado en el select
        const claseId = this.value;

        // Actualizar la URL del enlace con el nuevo valor
        enlaceClase.href = `/maestros/misclases/${claseId}`;
    });


</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var id = $('#selectedClass').val();
        console.log(id);

        $('#claseClase').on('change', function() {
            console.log('Cambio detectado:', $(this).val());
            $('#selectedClass').val($(this).val());
        });
    });


</script>

<script>
    var ctx = document.getElementById('graficaPastel').getContext('2d');
    var asistencias = @json($asistencias);

    console.log(asistencias);

    if (asistencias.length == 0){
        var chartIndicacion = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Sin Asistencias'],
                datasets: [{
                    data: [1], // Valor 1 para el único segmento
                    backgroundColor: ['rgba(200, 200, 200, 0.6)'] // Gris claro
                }]
            }
        });

    }else{
        var nombresUsuarios = asistencias.map(function(usuario) {
            return usuario.name;
        });

        var asistenciasTotales = asistencias.map(function(usuario) {
            return usuario.total_asistencias;
        });

        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: nombresUsuarios,
                datasets: [{
                    data: asistenciasTotales,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                    ]
                }]
            }
        });

    }


    
</script>

<script>
    var ctx = document.getElementById('graficaAsistencias').getContext('2d');
    var asistencias = @json($asistencias);

    var nombresUsuarios = asistencias.map(function(usuario) {
        return usuario.name;
    });

    var asistenciasTotales = asistencias.map(function(usuario) {
        return usuario.total_asistencias;
    });

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombresUsuarios,
            datasets: [{
                label: 'Asistencias Totales',
                data: asistenciasTotales,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
    
@endsection
