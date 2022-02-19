@section('title', __('Personas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>Listado de personas </h4>
						</div>
						@if (session()->has('create'))
						<div wire:poll.4s class="btn btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('create') }} </div>
						@elseif (session()->has('delete'))
						<div wire:poll.4s class="btn btn-danger" style="margin-top:0px; margin-bottom:0px;"> {{ session('delete') }} </div>
						@elseif (session()->has('update'))
						<div wire:poll.4s class="btn btn-info" style="margin-top:0px; margin-bottom:0px;"> {{ session('update') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar personas">
						</div>
						<div class="btn btn-success" data-toggle="modal" data-target="#createDataModal">
						A&ntilde;adir Personas
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.personas.create')
						@include('livewire.personas.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Dpi</th>
								<th>Nit</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<td>Acciones</td>
							</tr>
						</thead>
						<tbody>
							@foreach($personas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->dpi }}</td>
								<td>{{ $row->nit }}</td>
								<td>{{ $row->nombres }}</td>
								<td>{{ $row->apellidos }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Desea eliminar la persona {{$row->nombres}}?\nSi elimina la persona, ya no se puede recuperar!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Eliminar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $personas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
