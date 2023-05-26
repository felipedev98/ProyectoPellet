<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bodegas') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


        <x-table>

            <div class="px-6 py-3 flex items-center bg-gray-200">

                <x-input class="flex-1 mr-4" placeholder="Buscar bodega por nombre o dirección" type="text"
                    wire:model="search" />

                @livewire('create-bodega')


            </div>

            @if ($bodegas->count())

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-40">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-10 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('id')">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order('nombre')">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order"('direccion')>
                                Dirección
                            </th>
                            <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="order"('descripcion')>
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($bodegas as $item)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->direccion }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->descripcion }}
                                </td>
                                <td class="px-6 py-4 flex">
                                    <a class="btn btn-green" wire:click="edit({{ $item }})"> <i
                                            class="fas fa-edit"> </i></a>

                                    <a class="btn btn-red ml-2" wire:click="$emit('deleteBodega', {{ $item->id }})"> <i class="fas fa-trash"> </i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <div class="px-6 py-3">
                    No existe bodega coincidente.
                </div>

            @endif

        </x-table>



    </div>


    <x-dialog-modal wire:model="open_edit">

        <x-slot name='title'>
            Editar bodega
        </x-slot>

        <x-slot name='content'>

            <div wire:loading wire:targer="image"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Cargando imagen...</strong>
                <span class="block sm:inline">Espere hasta que la imagen se haya procesado.</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @else
                <img src="{{ Storage::url($bodega->image) }}" alt="">
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
                <textarea wire:model="bodega.descripcion" rows="6" class="form-control w-full"> </textarea>
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-input-error for="image" />
            </div>

        </x-slot>

        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>


    @push('js')
        <script src="sweetalert2.all.min.js"></script>

        <script>
            Livewire.on('deleteBodega', bodegaId =>{
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                Livewire.emitTo('show-bodegas', 'delete', bodegaId);

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
            });
        </script>
    @endpush


</div>
