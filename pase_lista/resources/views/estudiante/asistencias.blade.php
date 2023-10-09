@extends('layouts.app3')
@section('titulo')
    Asistencias
@endsection

@section('contenido_top')
    <div
        class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@endsection

@section('contenido')
<br> <br>
    <div class="relative w-full mx-auto mt-500 ">

        <div
            class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div
                        class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                        <img src="{{ asset('img/estudiante/asistencias.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1 dark:text-black">Mis Asistencias</h5>
                        <p class="mb-0 font-semibold leading-normal dark:text-black dark:opacity-60 text-sm">Estudiante</p>
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
                        <p class="mb-0 dark:text-black/80">Asistencia de Estudiantes</p>
                    </div>
                    
                    <br>

                    <div class="mb-4">
                        <label for="fechaFiltro" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Filtrar por Fecha</label>
                        <select id="fechaFiltro" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                            <option value="">Todas las Clases</option>
                            @foreach($clases as $clase)
                                <option value="{{ $clase->id }}">{{ $clase->claseInfo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                
                        <table id="tablaAsistencias" class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="dark:text-black/80" style="text-align: justify;">Fecha</th>
                                    <th class="dark:text-black/80" style="text-align: justify;">Clase</th>
                                    <th class="dark:text-black/80" style="text-align: justify;">Horario</th>
                                    <th class="dark:text-black/80" style="text-align: justify;">Asistencia</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <tr>
                                    <td class="fecha-asistencia"></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        
                                    </td>
                                </tr>
                           

                            </tbody>
                        </table>
                        <br>

                    
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


@endsection
