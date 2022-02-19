<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CalTipocuenta;

class CalTipocuentas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $descripcion, $debaja;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tipocuentas.view', [
            'tipo_cuentas' => CalTipocuenta::orderby('nombre')
						->WhereNull('debaja')
                        ->where(function ($query) use ($keyWord) {
                            $query->orWhere('nombre', 'LIKE', $keyWord)
                            ->orWhere('descripcion', 'LIKE', $keyWord);
                        })
						->paginate(10),
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
		$this->descripcion = null;
		$this->debaja = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
        ]);

        CalTipocuenta::create([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('create', 'La cuenta fue creado correctamente.');
    }

    public function edit($id)
    {
        $record = CalTipocuenta::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->descripcion = $record-> descripcion;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'descripcion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = CalTipocuenta::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'descripcion' => $this-> descripcion,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('update', 'Se ha actualizado correctamente la cuenta.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = CalTipocuenta::where('id', $id);
            $record->update([
                'debaja' => $this->debaja = now()
            ]);
            session()->flash('delete', 'Se ha eliminado correctamente!');
        }
    }
}
