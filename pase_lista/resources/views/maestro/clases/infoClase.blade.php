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

@foreach ($clases as $clase)
<br> <br>
    <div class="relative w-full mx-auto mt-500 ">
        <div
            class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div
                        class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
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
                        <p class="mb-0 dark:text-black/80">Información - Pase de lista</p>
                    </div>
                </div>

                <canvas id="graficaAsistencias" width="400" height="200"></canvas>
            </div>
            
        </div>

    </div>
</div>


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
