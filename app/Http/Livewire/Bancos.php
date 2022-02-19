<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Banco;

class Bancos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $debaja;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.bancos.view', [
            'bancos' => Banco::latest('nombre')
						->orWhere('nombre', 'LIKE', $keyWord)
						->where('debaja', '=', null)
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
		$this->debaja = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
        ]);

        Banco::create([ 
			'nombre' => $this-> nombre,
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Banco Successfully created.');
    }

    public function edit($id)
    {
        $record = Banco::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->debaja = $record-> debaja;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required'
        ]);

        if ($this->selected_id) {
			$record = Banco::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Banco Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Banco::where('id', $id);
            $record->update([
                'debaja' => $this->debaja = now()
            ]);
            session()->flash('message', 'Baco Successfully Delete.');
        }
    }
}
