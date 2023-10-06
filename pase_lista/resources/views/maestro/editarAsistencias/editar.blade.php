@extends('layouts.app')

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
<br> <br>
    <div class="relative w-full mx-auto mt-500 ">

        <div
            class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3">
                    <div
                        class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                        <img src="{{ asset('img/estudiante.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1 dark:text-black">Editar Asistencias</h5>
                        <p class="mb-0 font-semibold leading-normal dark:text-black dark:opacity-60 text-sm">Maestro</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full h-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex items-center">
                            <p class="mb-0 dark:text-black/80 text-xl font-semibold">Registro de Asistencias</p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <form action="#" method="POST" novalidate>
                            @csrf
                            <div class="mb-4">
                                <label for="mes" class="block text-sm font-medium text-gray-700">Selecciona el Estudiante</label>
                                <select id="mes" name="mes" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                                    <option value="Enero">Liam</option>
                                    <option value="Febrero">Zayn</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="mes" class="block text-sm font-medium text-gray-700">Selecciona el Mes</label>
                                <select id="mes" name="mes" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="semana" class="block text-sm font-medium text-gray-700">Selecciona la Semana</label>
                                <select id="semana" name="semana" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                                    <option value="Semana 1">Semana 1</option>
                                    <option value="Semana 2">Semana 2</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Asistencia de Lunes a Viernes</label>
                                <div class="flex flex-wrap items-center mt-2">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="lunes" class="form-checkbox text-blue-500">
                                        <span class="ml-2">Lunes</span>
                                    </label>
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="martes" class="form-checkbox text-blue-500">
                                        <span class="ml-2">Martes</span>
                                    </label>
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="miercoles" class="form-checkbox text-blue-500">
                                        <span class="ml-2">Miércoles</span>
                                    </label>
                                    <label class="inline-flex items-center mr-4">
                                        <input type="checkbox" name="jueves" class="form-checkbox text-blue-500">
                                        <span class="ml-2">Jueves</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="viernes" class="form-checkbox text-blue-500">
                                        <span class="ml-2">Viernes</span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800 w-full">Guardar Asistencias</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:flex-0 md:mt-0">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                    <img class="w-full rounded-t-2xl" src="{{ asset('img/login_2.png') }}" alt="profile cover image">

                </div>
            </div>
        </div>
    </div>
    

  

    
    
@endsection
