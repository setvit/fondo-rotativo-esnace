<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Comisión: {{ $comision->codigo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('comisiones.update', $comision) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Código -->
                            <div>
                                <x-input-label for="codigo" value="Código" />
                                <x-text-input 
                                    id="codigo" 
                                    name="codigo" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    :value="old('codigo', $comision->codigo)" 
                                    required 
                                    autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('codigo')" />
                            </div>

                            <!-- Tipo -->
                            <div>
                                <x-input-label for="tipo" value="Tipo de Comisión" />
                                <select name="tipo" id="tipo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="NACIONAL" {{ old('tipo', $comision->tipo) == 'NACIONAL' ? 'selected' : '' }}>NACIONAL</option>
                                    <option value="INTERNACIONAL" {{ old('tipo', $comision->tipo) == 'INTERNACIONAL' ? 'selected' : '' }}>INTERNACIONAL</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('tipo')" />
                            </div>

                            <!-- Destino -->
                            <div>
                                <x-input-label for="destino" value="Destino" />
                                <x-text-input 
                                    id="destino" 
                                    name="destino" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    :value="old('destino', $comision->destino)" 
                                    placeholder="Ej: MIAMI"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('destino')" />
                            </div>

                            <!-- Motivo -->
                            <div class="md:col-span-2">
                                <x-input-label for="motivo" value="Motivo de la Comisión *" />
                                <textarea 
                                    id="motivo" 
                                    name="motivo" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('motivo') border-red-500 @enderror" 
                                    rows="2" 
                                    placeholder="Ej: CURSO DE ESPECIALIZACIÓN EN SEGURIDAD NAVAL"
                                    required>{{ old('motivo', $comision->motivo) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('motivo')" />
                            </div>

                            <!-- Fecha Salida -->
                            <div>
                                <x-input-label for="fecha_salida" value="Fecha de Salida" />
                                <x-text-input 
                                    id="fecha_salida" 
                                    name="fecha_salida" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    :value="old('fecha_salida', $comision->fecha_salida->format('Y-m-d'))" 
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_salida')" />
                            </div>

                            <!-- Fecha Retorno -->
                            <div>
                                <x-input-label for="fecha_retorno" value="Fecha de Retorno" />
                                <x-text-input 
                                    id="fecha_retorno" 
                                    name="fecha_retorno" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    :value="old('fecha_retorno', $comision->fecha_retorno->format('Y-m-d'))" 
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_retorno')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('comisiones.show', $comision) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                                Cancelar
                            </a>
                            <x-primary-button>
                                Actualizar Comisión
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>