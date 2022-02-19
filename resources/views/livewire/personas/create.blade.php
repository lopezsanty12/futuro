<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="dpi"></label>
                <input wire:model="dpi" type="text" class="form-control" id="dpi" placeholder="DPI">@error('dpi') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nit"></label>
                <input wire:model="nit" type="text" class="form-control" id="nit" placeholder="NIT">@error('nit') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="nombres"></label>
                <input wire:model="nombres" type="text" class="form-control" id="nombres" placeholder="Nombres">@error('nombres') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="apellidos"></label>
                <input wire:model="apellidos" type="text" class="form-control" id="apellidos" placeholder="Apellidos">@error('apellidos') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="id_cuenta"></label>
                <select wire:model="id_cuenta" type="text" class="form-control" id="id_cuenta" placeholder="Cuenta">@error('id_cuenta') <span class="error text-danger">{{ $message }}</span> @enderror
                    <option>Seleccione Cuenta</option>
                    @foreach($cuentas as $cuenta)
                    <option value = "{{$cuenta->id}}">
                        {{$cuenta->nombre}}
                    </option>
                    @endforeach
                </select>
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
