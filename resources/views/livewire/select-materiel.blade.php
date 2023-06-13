<div>
	<!-- La variable résultante est:
		$materiel
	-->
    {{-- The whole world belongs to you. --}}

    <div class="form-group row">
		<label for="type_materiel" class="col-md-4 col-form-label text-md-right">Type du Matériel</label>
		<div class="col-md-6">
			<select wire:model="selectedtypeMateriel" class="form-control" id="type_materiel">
				<option value="null" selected>
					Choisir le type du matériel
				</option>
				@foreach($typeMateriels as $typeMateriel)
					<option value="{{$typeMateriel->id}}">
						{{$typeMateriel->type}}
					</option>
				@endforeach
			</select>
		</div>
	</div>

	@if( !is_null($selectedtypeMateriel) )
    <div class="form-group row">
		<label for="materiel" class="col-md-4 col-form-label text-md-right">Matériel</label>
		<div class="col-md-6">
			<select wire:model="selectedMateriel" class="form-control" id="materiel">
				<option value="null" selected>
					Choisir un matériel
				</option>
				@foreach($materiels as $materiel)
					<option value="{{$materiel->id}}">
						{{$materiel->name}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif
	@if( !is_null($selectedMateriel) )
		<input type="text" name="materiel" class="form-control" value="{{$selectedMateriel}}" hidden>
	@endif
</div>
