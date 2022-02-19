<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CalCuenta;
use App\Models\CalTipocuenta;

class CalCuentas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $tipocuentas, $minimo, $debaja;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.cuentas.view', [
            'cuentas' => CalCuenta::orderby('cal_cuentas.nombre')
                        ->join('cal_tipocuentas','cal_cuentas.tipocuentas','=','cal_tipocuentas.id')
                        ->select('cal_cuentas.id','cal_cuentas.nombre','cal_tipocuentas.nombre as cuenta', 'cal_cuentas.minimo', 'cal_cuentas.debaja')
                        ->WhereNull('cal_cuentas.debaja')
                        ->where(function ($query) use ($keyWord) {
                            $query->orWhere('cal_cuentas.nombre', 'LIKE', $keyWord)
                            ->orWhere('cal_tipocuentas.nombre', 'LIKE', $keyWord)
                            ->orWhere('cal_cuentas.minimo', 'LIKE', $keyWord);
                            })
						->paginate(10),
            'tipo_cuenta' => CalTipocuenta::orderby('nombre')
                        ->WhereNotNull('debaja')    
                        ->get()             
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nombre = null;
		$this->tipocuentas = null;
		$this->minimo = null;
		$this->debaja = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
        ]);

        CalCuenta::create([ 
			'nombre' => $this-> nombre,
			'tipocuentas' => $this-> tipocuentas,
			'minimo' => $this-> minimo,
			'debaja' => $this-> debaja
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('create', 'Se creo correctamente la Cuenta.');
    }

    public function edit($id)
    {
        $record = CalCuenta::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->tipocuentas = $record-> tipocuentas;
		$this->minimo = $record-> minimo;
		$this->debaja = $record-> debaja;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
        ]);

        if ($this->selected_id) {
			$record = CalCuenta::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'tipocuentas' => $this-> tipocuentas,
			'minimo' => $this-> minimo,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Se ha actualizado correctamente la cuenta.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = CalCuenta::where('id', $id);
            $record->update([
                'debaja' => $this->debaja = now()
            ]);
            session()->flash('delete', 'Se ha eliminado correctamente la cuenta!');
        }
    }
}
