<div>
    <x-danger-button wire:click="$set('open', true)">

        Crear bodega

    </x-danger-button>


    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nueva bodega
        </x-slot>

        <x-slot name="content">

        <div wire:loading wire:targer="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Cargando imagen...</strong>
            <span class="block sm:inline">Espere hasta que la imagen se haya procesado.</span>
        </div>

        @if ($image)
            <img class="mb-4" src="{{$image->temporaryUrl()}}">
        @endif

            <div class="mb-4">
                <x-label value="Nombre bodega" />
                <x-input type="text" class="w-full" wire:model="nombre"/>

                <x-input-error for="nombre"/>

            </div>

            <div class="mb-4">
                <x-label value="Dirección" />
                <x-input type="text" class="w-full" wire:model="direccion"/>

                <x-input-error for="direccion"/>

            </div>

            <div class="mb-4">
                <x-label value="Descripción" />
                <textarea class="form-control w-full" rows="6" wire:model="descripcion"> </textarea>

                <x-input-error for="descripcion"/>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{$identificador}}">
                <x-input-error for="image"/>
            </div>

        </x-slot>

        <x-slot name="footer">

                <x-secondary-button wire:click="$set('open', false)" class="mr-4">
                    Cancelar
                </x-secondary-button>

                <x-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled:opacity-25">
                    Crear bodega
                </x-danger-button>


        </x-slot>


    </x-dialog-modal>

</div>
