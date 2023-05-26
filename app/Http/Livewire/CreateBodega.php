<?php

namespace App\Http\Livewire;

use App\Models\Bodega;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBodega extends Component
{
    use WithFileUploads;

    public $open = false;

    public $nombre, $direccion, $descripcion, $image, $identificador;

    public function mount(){
        $this->identificador = rand();

    }

    protected $rules = [
        'nombre' => 'required',
        'direccion' => 'required',
        'descripcion' => 'required',
        'image' => 'required|image|max:2048'
    ];

    // public function updated($propertyName){
    //     $this->validateOnly($propertyName);

    // }

    public function save(){


        $this->validate();

        $image = $this->image->store('bodegas');



        Bodega::create([
            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'descripcion' => $this->descripcion,
            'image' => $image
        ]);

        $this->reset(['open', 'nombre', 'direccion', 'descripcion', 'image']);

        $this->identificador = rand();


        $this->emitTo('show-bodegas', 'render');
        $this->emit('alert', 'Bodega creda con éxito');

    }
    public function render()
    {
        return view('livewire.create-bodega');
    }
}
