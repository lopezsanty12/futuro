<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Persona;

class Personas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $dpi, $nit, $nombres, $apellidos, $debaja;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.personas.view', [
            'personas' => Persona::orderby('nombres') 
                        ->WhereNull('debaja')
                        ->where(function ($query) use ($keyWord) {
                            $query->where('dpi', 'LIKE', $keyWord)
                            ->orWhere('nit', 'LIKE', $keyWord)
                            ->orWhere('nombres', 'LIKE', $keyWord)
                            ->orWhere('apellidos', 'LIKE', $keyWord);
                        })
                        ->paginate(10)
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->dpi = null;
		$this->nit = null;
		$this->nombres = null;
		$this->apellidos = null;
		$this->debaja = null;
    }

    public function store()
    {
        $this->validate([
		'dpi' => 'required',
		'nit' => 'required',
		'nombres' => 'required',
		'apellidos' => 'required',
        ]);

        Persona::create([ 
			'dpi' => $this-> dpi,
			'nit' => $this-> nit,
			'nombres' => $this-> nombres,
			'apellidos' => $this-> apellidos
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('create', 'Se ha creado correctamente la persona');
    }

    public function edit($id)
    {
        $record = Persona::findOrFail($id);

        $this->selected_id = $id; 
		$this->dpi = $record-> dpi;
		$this->nit = $record-> nit;
		$this->nombres = $record-> nombres;
		$this->apellidos = $record-> apellidos;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'dpi' => 'required',
		'nit' => 'required',
		'nombres' => 'required',
		'apellidos' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Persona::find($this->selected_id);
            $record->update([ 
			'dpi' => $this-> dpi,
			'nit' => $this-> nit,
			'nombres' => $this-> nombres,
			'apellidos' => $this-> apellidos
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('update', 'Se ha actulizado correctamente los datos!');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Persona::where('id', $id);
            $record->update([
                'debaja' => $this->debaja = now()
            ]);
            session()->flash('delete', 'Se ha eliminado correctamente!');
        }
    }
}
