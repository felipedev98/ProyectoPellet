<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"> </i>
    </a>

    <x-dialog-modal wire:model="open">

        <x-slot name='title'>
            Editar bodega
        </x-slot>

        <x-slot name='content'>

        <div wire:loading wire:targer="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Cargando imagen...</strong>
            <span class="block sm:inline">Espere hasta que la imagen se haya procesado.</span>
        </div>

        @if ($image)
            <img class="mb-4" src="{{$image->temporaryUrl()}}">

        @else
            <img src="{{Storage::url($bodega->image)}}" alt="">

        @endif



            <div class="mb-4">
                <x-label value="Nombre bodega" />
                <x-input wire:model="bodega.nombre" type="text" class="w-full" />
            </div>

            <div class="mb-4">
                <x-label value="Dirección" />
                <x-input wire:model="bodega.direccion" type="text" class="w-full" />
            </div>

            <div class="mb-4">
                <x-label value="Descripción" />
                <textarea wire:model="bodega.descripcion" rows="6" class="form-control w-full" > </textarea>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-input-error for="image"/>
            </div>

        </x-slot>

        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="save" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


</div>
