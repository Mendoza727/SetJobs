<form action="" novalidate class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo" 
            :value="old('titulo')"  
            placeHolder="Titulo Vacante"
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select 
                wire:model="salario" 
                id="salario"
                class="
                border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm
                w-full"
        >
        <option value="" selected>-- Seleccione --</option>
        @foreach ($salarios as $salario )
            <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select 
                wire:model="categoria" 
                id="categoria"
                class="
                border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm
                w-full"
        >
        <option value="" selected>-- Seleccione --</option>
        @foreach ($categorias as $categoria )
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')"  
            placeHolder="Ingresa Nombre Empresa"
        />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="f_expiracion" :value="__('Fecha expiracion vacante')" />
        
        <x-text-input 
            id="f_expiracion" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="f_expiracion" 
            :value="old('f_expiracion')" 
        />
        <x-input-error :messages="$errors->get('f_expiracion')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripción puesto')" />
        
        <textarea 
            wire:model="descripcion"  
            id="descripcion"
            class="
                border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm
                w-full"
            placeholder="Descripcion general del puesto, experiencia, estudios y otras cosas..." 
            cols="20" 
            rows="10"
        ></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>

   <div>
    <x-input-label for="imagen_nueva" :value="__('Imagen')" />
        
    <x-text-input 
        id="imagen_nueva" 
        class="block mt-1 w-full" 
        type="file" 
        wire:model="imagen_nueva"
        accept=".png, .jpeg, .jpg, .gif"
    />
    <x-input-error :messages="$errors->get('imagen_nueva')" class="mt-2" />

    <div class="my-5">
        @if ($imagen_nueva)
            Preview:
            <img src="{{ $imagen_nueva->temporaryUrl() }}">
        @endif
    </div> 
        <x-input-label for="descripcion" :value="__('Imagen Actual')" />
        <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'imagen Vacante ' . $titulo }}">
   </div>

    <x-primary-button class="w-full justify-center">
        {{ __('Guardar Cambios') }}
    </x-primary-button>
</form>
