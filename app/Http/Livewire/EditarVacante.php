<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $f_expiracion;
    public $descripcion;
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    protected $rules = [
        'titulo'       => 'required|string',
        'salario'      => 'required',
        'categoria'    => 'required',
        'empresa'      => 'required',
        'f_expiracion' => 'required',
        'descripcion'  => 'required',
        'imagen_nueva' => 'nullable|image|file'
    ];


    public function mount(Vacante $vacante)
    {
        $this->vacante_id       = $vacante->id;
        $this->titulo           = $vacante->titulo;
        $this->salario          = $vacante->salario_id;
        $this->categoria        = $vacante->categoria_id;
        $this->empresa          = $vacante->empresa;
        $this->f_expiracion     = Carbon::parse( $vacante->f_expiracion)->format('Y-m-d');
        $this->descripcion      = $vacante->descripcion;
        $this->imagen           = $vacante->imagen;
    }

    public function editarVacante()
    {
        $data = $this->validate();

        //si hay nueva imagen
        if( $this->imagen_nueva ) {
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $data['imagen'] = str_replace('public/vacantes/', '', $imagen); 
        }

        //encontrar vacante a editar
        $vacante = Vacante::find($this->vacante_id);
        
        //reescribir los valores
        $vacante->titulo         = $data['titulo'];
        $vacante->salario_id     = $data['salario'];
        $vacante->categoria_id   = $data['categoria'];
        $vacante->empresa        = $data['empresa'];
        $vacante->f_expiracion   = $data['f_expiracion'];
        $vacante->descripcion    = $data['descripcion'];
        $vacante->imagen         = $data['imagen'] ?? $vacante->imagen;
        //guardar la vacante
        $vacante->save();

        //reedireccionar al usuario
        session()->flash('mensaje', 'Cambios Realizados Correctamente');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', [
            'salarios'   => $salarios,
            'categorias' => $categorias
        ]);
    }
}
