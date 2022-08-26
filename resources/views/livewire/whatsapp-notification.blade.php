<div>
<li class="nav-item dropdown ml-lg-2">
			<a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" data-toggle="dropdown">
<i class="align-middle fas fa-bell"></i>
@if($quantity>0)<span class="indicator"></span>@endif
</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
				<div class="dropdown-menu-header">
					{{$quantity}} {{$quantity == 1 ? 'Mensaje nuevo':'Mensajes nuevos'}}
				</div>
				<div class="list-group" style="overflow-y: scroll;max-height: 400px;">
					@foreach($notifications as $item)
					<a href="/clients/{{$item->c_id}}/edit" class="list-group-item">
						<div class="row no-gutters align-items-center">
							<div class="col-2">
								<i class="ml-1 text-warning fas fa-fw fa-envelope-open"></i>
							</div>
							<div class="col-10">
								<div class="text-dark">{{$item->nombre}}</div>
								<div class="text-muted small mt-1">{{$item->txt}}</div>
								<div class="text-muted small mt-1">{{$item->created_at->diffForHumans()}}</div>
							</div>
						</div>
					</a>
					@endforeach

				</div>
				@if($quantity>0)<div class="dropdown-menu-footer">
					<a href="/dashboard" class="text-muted">Mostrar todos</a>
				</div>@endif
			</div>
		</li>
</div>
