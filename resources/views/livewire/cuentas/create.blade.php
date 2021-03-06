<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear nueva cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="nombre"></label>
                <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="tipocuentas"></label>
                <select wire:model="tipocuentas" type="text" class="form-control" id="tipocuentas" placeholder="Tipocuentas">@error('tipocuentas') <span class="error text-danger">{{ $message }}</span> @enderror
                    <option>Seleccione tipo de cuenta</option>
                    @foreach($tipo_cuenta as $tipocuenta)
                    <option value = "{{$tipocuenta->id}}">
                        {{$tipocuenta->nombre}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="minimo"></label>
                <input wire:model="minimo" type="number" step="any" class="form-control" id="minimo" placeholder="Minimo">@error('minimo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
