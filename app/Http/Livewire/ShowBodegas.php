<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Bodega;

class ShowBodegas extends Component
{

    public $search, $bodega, $image, $identificador;
    public $sort = 'id';
    public $direction = "desc";

    public $open_edit = false;

    protected $listeners = ['render', 'delete'];
    public function mount(){
        $this->identificador = rand();
        $this->bodega = new Bodega();
    }


    protected $rules = [
        'bodega.nombre' => 'required',
        'bodega.direccion' => 'required',
        'bodega.descripcion' => 'required'
    ];


    
    public function render()
    {
        $bodegas = Bodega::where('nombre','like', '%' . $this->search . '%')
                            ->orWhere('direccion','like', '%' . $this->search . '%')
                            ->orderBy($this->sort, $this->direction)
                            ->get();

        return view('livewire.show-bodegas', compact('bodegas'));
    }

    // public function order($sort){
    //     $this->sort = $sort;
    // }

    public function order($column_name = '$sort')
    {
        $this->sort = $column_name;
            if ($column_name) {
                if ($this->sort == $column_name) {
                    $this->direction = $this->direction == 'desc' ? 'asc' : 'desc';
                }else{
                    $this->direction == 'asc';
                }
            }        
    }

    public function edit(Bodega $bodega){
        $this->bodega = $bodega;
        $this->open_edit = true;

    }

    public function update(){
        $this->validate();

        if ($this->image){
            Storage::delete([$this->bodega->image]);

            $this->bodega->image = $this->image->store('bodegas');

        }

        $this->bodega->save();

        $this->reset(['open_edit', 'image']);

        $this->identificador = rand();

        $this->emit('alert', 'Bodega editada con éxito');
    }

    public function delete(Bodega $bodega){
        $bodega->delete();
    }
}
