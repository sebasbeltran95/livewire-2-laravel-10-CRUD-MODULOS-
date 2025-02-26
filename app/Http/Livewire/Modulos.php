<?php

namespace App\Http\Livewire;

use App\Models\Modelos;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class Modulos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nombre_modulo, $profesor;
    public $idx,$nombre_modulox, $profesorx;
    public $search  = "";

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getModulosProperty()
    {
        if ($this->search == "") {
            return Modelos::orderBy('id','DESC')->paginate(5);
        } else {
            return Modelos::orWhere('nombre_modulo', 'LIKE', '%'.$this->search.'%')
                ->orWhere('profesor', 'LIKE', '%'.$this->search.'%')
                ->paginate(3);
        }
 
    }

    public function crear()
    {
        try {
            $this->validate([
                'nombre_modulo' => 'required|string|max:100',
                'profesor' => 'required|string|max:100',
            ],[
                'nombre_modulo.required' => 'El campo Nombre Modulo es obligatorio',
                'nombre_modulo.string' => 'El campo Nombre Modulo recibe solo cadena de texto',
                'nombre_modulo.max' => 'El campo Nombre Modulo debe contener maximo 100 caracteres',
                'profesor.required' => 'El Profesor es obligatorio',
                'profesor.string' => 'El Profesor recibe solo cadena de texto',
                'profesor.max' => 'El Profesor debe contener maximo 100 caracteres',
            ]);

            $user = new Modelos();
            $user->nombre_modulo =  $this->nombre_modulo;
            $user->profesor =  $this->profesor;
            $user->save();
            $this->reset();
            $msj = ['!Registrado!', 'Se registro el modulo', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->nombre_modulox =  $obj['nombre_modulo'];
        $this->profesorx = $obj['profesor'];
    }
    public function actua()
    {
        try {

            $this->validate([
                'nombre_modulox' => 'required|string|max:100',
                'profesorx' => 'required|string|max:100',
            ],[
                'nombre_modulox.required' => 'El campo Nombre Modulo es obligatorio',
                'nombre_modulox.string' => 'El campo Nombre Modulo recibe solo cadena de texto',
                'nombre_modulox.max' => 'El campo Nombre Modulo debe contener maximo 100 caracteres',
                'profesorx.required' => 'El Profesor es obligatorio',
                'profesorx.string' => 'El Profesor recibe solo cadena de texto',
                'profesorx.max' => 'El Profesor debe contener maximo 100 caracteres',
            ]);

    
            $data = Modelos::find($this->idx);
            $data->nombre_modulo = $this->nombre_modulox;
            $data->profesor = $this->profesorx;
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo el modulo', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function delete($post)
    {
        try { 

            Modelos::where('id',$post)->first()->delete();

         } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function render()
    {
        return view('livewire.modulos')->extends('layouts.plantilla')->section('content');
    }
}
