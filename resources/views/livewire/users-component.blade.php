<div>

@section('title','Listado de usuarios')
<div x-data="userComponent">

<div class="row" >
	<div class="col-12">
		<div class="card">
	<div class="card-header">
				<h5 class="card-title">Cantidad de usuarios: {{$quantity}}</h5>
			</div>
			<div class="card-body">
		<button class="btn btn-success m-3" x-on:click="addUser">Nuevo usuario</button>
		
			<table class="table table-striped" id="tabla">
				<thead>
					<tr>
						<th class="">Nombre</th>
						<th class="">Email</th>
						<th class="">Rol</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $item)
					<tr>
						<td class="">{{$item->name}}</td>
						<td class="">{{$item->email}}</td>
						<td class="">{{$item->getRoleNames()[0] ?? ""}}</td>
						<td><button class="btn btn-primary" x-on:click="editUser({{$item->id}})" title="Editar"><i class="fas fa-fw fa-edit"></i></button>
            			<button class="btn btn-danger" x-on:click="delUser({{$item->id}})" title="Eliminar"><i class="fas fa-fw fa-trash"></i></button></td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>


<div class="modal fade show" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" x-text="editMode ? 'Editar usuario':'Agregar usuario'"></h5>
        <button type="button" class="close" x-on:click="closeModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="saveUser">
			<div class="mb-3 row">
				<label class="col-form-label col-sm-2 text-sm-end">Nombre</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Nombre" wire:model.defer="name">
				</div>
				@error("name")<span class="offset-sm-2 col-sm-10 text-danger">{{$message}}</span>@enderror
			</div>
			<div class="mb-3 row">
				<label class="col-form-label col-sm-2 text-sm-end">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" placeholder="Email" wire:model.defer="email">
				</div>
				@error("email")<span class="offset-sm-2 col-sm-10 text-danger">{{$message}}</span>@enderror
			</div>
			<div class="mb-3 row">
				<label class="col-form-label col-sm-2 text-sm-end">Contraseña</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="Contraseña" wire:model.defer="pass">
				</div>
				@error("pass")<span class="offset-sm-2 col-sm-10 text-danger">{{$message}}</span>@enderror
			</div>
			<div class="mb-3 row">
				<label class="col-form-label col-sm-2 text-sm-end">Rol</label>
				<div class="col-sm-10">
					<select class="form-control mb-3" wire:model.defer="role">
						<option value="" selected="">-- Seleccione --</option>
						@foreach($roles as $item)
							<option value="{{$item->name}}">{{$item->name}}</option>
						@endforeach
					</select>
				</div>
				@error("role")<span class="offset-sm-2 col-sm-10 text-danger">{{$message}}</span>@enderror
			</div>

		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" x-on:click="closeModal">Cancelar</button>
        <button type="button" class="btn btn-primary" x-on:click="saveUser" x-text="editMode ? 'Actualizar':'Guardar'"></button>
      </div>
    </div>
  </div>
</div>	

</div>
</div>
@push("scripts")
<script>
Livewire.on("closeModal",()=>{
	$("#addModal").modal("hide");
});
Livewire.on("toastre",event=>{
	toastr.error(event)
});
Livewire.on("toastrs",event=>{
	toastr.success(event)
});

function userComponent() 
{
	return {
		editMode:false,
		addUser(){
			this.editMode = false;
			this.$wire.user_id = 0;
			$("#addModal").modal("show");
		},
		closeModal(){
			$("#addModal").modal("hide");
		},
		editUser(model){
			console.log(model)
			this.editMode = true;
			this.$wire.setId(model);
			$("#addModal").modal("show");
		},
		delUser(id){
			let vm = this;
			Swal.fire({
			  title: 'Está seguro?',
			  text: "Esta acción no se puede revertir!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si, Eliminar!'
			}).then((result) => {
			  if (result.isConfirmed) {
			    vm.$wire.destroy(id);
			  }
			})
		},
		saveUser(){
			let vm = this;
			this.$wire.addUser()
		}
	}
}

</script>
@endpush