<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GenPersona;
use Illuminate\Support\Facades\DB;

class GenPersonas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $dpi, $nit, $nombres, $apellidos, $id_cuenta, $debaja;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        $cuentas = DB::table('cal_cuentas')->whereNull('debaja')->get();
        return view('livewire.personas.view', [
            'personas' => GenPersona::orderby('gen_personas.nombres') 
                        ->join('cal_cuentas','gen_personas.id_cuenta','=','cal_cuentas.id')
                        ->select('gen_personas.*','cal_cuentas.nombre as cuenta')
                        ->WhereNull('gen_personas.debaja')
                        ->where(function ($query) use ($keyWord) {
                            $query->where('dpi', 'LIKE', $keyWord)
                            ->orWhere('nit', 'LIKE', $keyWord)
                            ->orWhere('nombres', 'LIKE', $keyWord)
                            ->orWhere('apellidos', 'LIKE', $keyWord);
                        })
						->paginate(10),
            'cuentas' => $cuentas
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
		$this->id_cuenta = null;
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

        GenPersona::create([ 
			'dpi' => $this-> dpi,
			'nit' => $this-> nit,
			'nombres' => $this-> nombres,
			'apellidos' => $this-> apellidos,
			'id_cuenta' => $this-> id_cuenta,
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('create', 'Se ha registrado correctamente el registro');
    }

    public function edit($id)
    {
        $record = GenPersona::findOrFail($id);

        $this->selected_id = $id; 
		$this->dpi = $record-> dpi;
		$this->nit = $record-> nit;
		$this->nombres = $record-> nombres;
		$this->apellidos = $record-> apellidos;
		$this->id_cuenta = $record-> id_cuenta;
		$this->debaja = $record-> debaja;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'dpi' => 'required',
		'nit' => 'required',
		'nombres' => 'required',
		'apellidos' => 'required',
        ]);

        if ($this->selected_id) {
			$record = GenPersona::find($this->selected_id);
            $record->update([ 
			'dpi' => $this-> dpi,
			'nit' => $this-> nit,
			'nombres' => $this-> nombres,
			'apellidos' => $this-> apellidos,
			'id_cuenta' => $this-> id_cuenta,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('update', 'Se ha actualizado correctamente los datos!');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = GenPersona::where('id', $id);
            $record->update([
                'debaja' => $this->debaja = now()
            ]);
            session()->flash('delete', 'Se ha eliminado correctamente!');
        }
    }
}
