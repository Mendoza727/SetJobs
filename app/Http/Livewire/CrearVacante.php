<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $f_expiracion;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules = [
        'titulo'       => 'required|string',
        'salario'      => 'required',
        'categoria'    => 'required',
        'empresa'      => 'required',
        'f_expiracion' => 'required',
        'descripcion'  => 'required',
        'imagen'       => 'required|image|file'
    ];

    public function crearVacante()
    {
        $data = $this->validate();

        //almacenamos la imgen 

        $imagen = $this->imagen->store('public/vacantes');
        $data['imagen'] = str_replace('public/vacantes/', '', $imagen);
        
        //creamos la vacante
        Vacante::create([
            'titulo'        => $data['titulo'],
            'salario_id'    => $data['salario'],
            'categoria_id'  => $data['categoria'],
            'empresa'       => $data['empresa'],
            'f_expiracion'  => $data['f_expiracion'],
            'descripcion'   => $data['descripcion'],
            'imagen'        => $data['imagen'],
            'user_id'       => auth()->user()->id
        ]);

        //creamos un mensaje 
        session()->flash('mensaje', 'La Vacante se publicó correctamente');

        //redireccionamos al usuario
        return redirect()->route('dashboard');
    }
    
    public function render()
    {
        //consultar base de datos para traer informacion de los selects
        $salarios = Salario::all();
        $categorias = Categoria::all();


        return view('livewire.crear-vacante', [
            'salarios'   => $salarios,
            'categorias' => $categorias
        ]);
    }
}
