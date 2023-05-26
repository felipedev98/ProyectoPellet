<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bodega;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditBodega extends Component
{

    use WithFileUploads;
    public $open = false;

    public $bodega, $image, $identificador;

    protected $rules = [
        'bodega.nombre' => 'required',
        'bodega.direccion' => 'required',
        'bodega.descripcion' => 'required'
    ];

    public function mount(Bodega $bodega){
        $this->bodega = $bodega;

        $this->identificador = rand();
    }

    public function save(){
        $this->validate();

        if ($this->image){
            Storage::delete([$this->bodega->image]);

            $this->bodega->image = $this->image->store('bodegas');

        }

        $this->bodega->save();

        $this->reset(['open', 'image']);

        $this->identificador = rand();

        $this->emitTo('show-bodegas', 'render');

        $this->emit('alert', 'Bodega editada con éxito');
    }


    public function render()
    {
        return view('livewire.edit-bodega');
    }
}
