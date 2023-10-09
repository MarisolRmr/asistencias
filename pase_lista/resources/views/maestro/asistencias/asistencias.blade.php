@extends('layouts.app2')

@section('titulo')
    Editar Asistencias
@endsection
<!-- Agrega el elemento a la stack en app.blade.php -->
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido_top')
    <div
        class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<br>
@foreach ($clases as $clase)
<div class="relative w-full mx-auto mt-500">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
                <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                    <img src="{{ asset('img/maestro/asistencias.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
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
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">

        <div class="w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <div class="flex items-center">
                        <p class="mb-0 dark:text-black/80">Asistencia de Estudiantes</p>
                    </div>
                    
                    <br>

                    <div class="mb-4">
                        <label for="fechaFiltro" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Filtrar por Fecha</label>
                        <select id="fechaFiltro" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                            <option value="">Todas las fechas</option>
                            @foreach($fechasAsistencia as $fecha)
                                <option value="{{ $fecha }}">{{ $fecha }}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                
                    <form action="{{ route('maestros.asistencias.guardar') }}" method="POST" novalidate>
                        @csrf
                        <table id="tablaAsistencias" class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="dark:text-black/80" style="text-align: justify;">Fecha</th>
                                    <th class="dark:text-black/80" style="text-align: justify;">Matrícula</th>
                                    <th class="dark:text-black/80" style="text-align: justify;">Nombre del estudiante</th>
                                    <th class="dark:text-black/80" style="text-align: justify;">Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($asistencias as $asistencia)
                                <tr>
                                    <td class="fecha-asistencia">{{ $asistencia->fecha }}</td>
                                    <td>{{ $asistencia->username }}</td>
                                    <td>{{ $asistencia->user_name }}</td>
                                    <td>
                                        <input type="hidden" name="clase_id" value="{{ $asistencia->clase_id }}">
                                        <input type="hidden" name="asistencia[{{ $asistencia->clase_id }}][{{ $asistencia->asistencia_id }}][{{ $asistencia->fecha }}]" value="0">
                                        <input type="checkbox" name="asistencia[{{ $asistencia->clase_id }}][{{ $asistencia->asistencia_id }}][{{ $asistencia->fecha }}]" value="1" {{ $asistencia->asistencia == 1 ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <br>
                        <button type="submit" class="px-8 py-2 bg-blue-500 text-white rounded-lg">Guardar Asistencias</button>
                    </form>

                    
                </div>
                <br>
            </div>
        </div>
        
    </div>

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




<script>
    // Obtener la tabla y el selector de fecha
    const tablaAsistencias = document.querySelector('#tablaAsistencias');
    const selectorFecha = document.querySelector('#fechaFiltro');

    // Agregar un evento de cambio al selector de fecha
    selectorFecha.addEventListener('change', () => {
        const fechaSeleccionada = selectorFecha.value;

        // Iterar sobre las filas de la tabla y mostrar/ocultar según la fecha seleccionada
        Array.from(tablaAsistencias.querySelectorAll('tbody tr')).forEach((fila) => {
            const fechaFila = fila.querySelector('.fecha-asistencia').textContent;

            // Si la fecha coincide con la seleccionada o no se ha seleccionado ninguna fecha, mostrar la fila
            if (fechaSeleccionada === '' || fechaSeleccionada === fechaFila) {
                fila.style.display = 'table-row';
            } else {
                fila.style.display = 'none';
            }
        });
    });
</script>

@endsection
