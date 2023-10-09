@extends('layouts.app')

@section('titulo')
    Añadir Clase
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
                        <img src="{{ asset('img/admin/Clases.png') }}" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                    </div>
                </div>
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1 dark:text-black">Añadir Clases</h5>
                        <p class="mb-0 font-semibold leading-normal dark:text-black dark:opacity-60 text-sm">Administrador</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">


            <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <div class="flex items-center">
                            <p class="mb-0 dark:text-black/80">Ingrese los siguientes datos</p>

                        </div>
                    </div>

                    <form action="{{route("admin.clases.store")}}" method="POST" novalidate>
                        @csrf
                        <div class="flex-auto p-6">
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="nombre"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nombre de la materia</label>
                                            <select
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                name="materia" id="materia">
                                                <option value="">Seleccione</option>
                                                @if (count($materias) > 0)
                                                    @foreach ($materias as $materia)
                                                        <option value="{{ $materia->id }}"
                                                            {{ old('materia') == $materia->id ? 'selected' : '' }}>
                                                            {{ $materia->nombre }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No hay materias</option>
                                                @endif
                                            </select>
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="nombre"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Número de grupo</label>
                                            <select
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-900 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                name="grupo" id="grupo">
                                                <option value="">Seleccione</option>
                                                @if (count($grupo) > 0)
                                                    @foreach ($grupo as $g)
                                                        <option value="{{ $g->id }}"
                                                            {{ old('grupo') == $g->id ? 'selected' : '' }}>
                                                            {{ $g->nombre }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No hay grupos</option>
                                                @endif
                                            </select>
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="nombre"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nombre del maestro</label>
                                            <select
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300  bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                name="maestro" id="maestro">
                                                <option value="">Seleccione</option>
                                                @if (count($user) > 0)
                                                    @foreach ($user as $a)
                                                        <option value="{{ $a->id }}"
                                                            {{ old('maestro') == $a->id ? 'selected' : '' }}>
                                                            {{ $a->name  }} {{$a->apellido }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No hay maestros</option>
                                                @endif
                                            </select>
                                    </div>
                                </div>


                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Día que se impartirá</label>
                                        <select
                                            class="focus:shadow-primary-outline dark-bg-slate-850 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                            name="dia" id="dia">
                                            <option value="">Seleccione</option>
                                            <option value="Lunes">Lunes</option>
                                            <option value="Martes">Martes</option>
                                            <option value="Miercoles">Miércoles</option>
                                            <option value="Jueves">Jueves</option>
                                            <option value="Viernes">Viernes</option>
                                            <option value="Sabado">Sábado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Hora de inicio</label>
                                        <input type="time" id="hora_inicio" name="hora_inicio" placeholder="Contraseña del usuario"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none @error('direccion') border-red-500 @enderror"
                                            value="{{ old('hora_inicio') }}" />
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="username"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Hora de termino</label>
                                        <input type="time" id="hora_fin" name="hora_fin" placeholder="Contraseña del usuario"
                                            class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none @error('direccion') border-red-500 @enderror"
                                            value="{{ old('hora_fin') }}" />
                                    </div>
                                </div>

                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="nombre"
                                            class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Número de grupo</label>
                                            <select
                                                class="focus:shadow-primary-outline dark:bg-slate-850  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-900 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                                name="aula" id="aula">
                                                <option value="">Seleccione</option>
                                                @if (count($aula) > 0)
                                                    @foreach ($aula as $au)
                                                        <option value="{{ $au->id }}"
                                                            {{ old('aula') == $au->id ? 'selected' : '' }}>
                                                            {{ $au->nombre }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option value="">No hay aulas</option>
                                                @endif
                                            </select>
                                    </div>
                                </div>


                                
                            </div>

                            <input type="submit" value="Registrar"
                                class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25" />
                        </div>
                    </form>

                    

                </div>
            </div>

            <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:flex-0 md:mt-0">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">

                    <img class="w-full rounded-t-2xl" src="{{ asset('img/add_alumnos.png') }}" alt="profile cover image">

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
