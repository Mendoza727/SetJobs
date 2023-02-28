<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    use WithFileUploads;

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $data = $this->validate();


        //almacenamos el pdf en el storage
        $cv = $this->cv->store('public/cv');
        $data['cv'] = str_replace('public/cv/', '', $cv);

        //creamos el request de la vacante
        $this->vacante->candidatos()->create([
            'user_id'       => auth()->user()->id,
            'cv'            => $data['cv']
        ]);

        //Creamos una notificacion y enviamos un email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));

        //mostrar mensajes de postulacion exitosa
        session()->flash('mensaje', 'se envio correctamente tu informacion, mucha suerte');
        return redirect()->back();
        
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
