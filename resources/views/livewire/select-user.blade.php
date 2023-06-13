<div>
    <!-- La variable résultante est:
		$personne
	-->

	<div class="m-3"> <span class="fw-bolder fs-italic text-decoration-underline">Choisissez une personne</span> </div>
	<div class="form-group m-3 row">
		<label for="role" class="col-md-4 col-form-label text-md-right">Catégorie</label>
		<div class="col-md-6">
			<select wire:model="selectedRole" class="form-control" id="role">
				<option value="null" selected>
					Choisir une personne
				</option>
				@foreach($roles as $role)
					<option value="{{$role}}">
						{{$role}}
					</option>
				@endforeach
			</select>
		</div>
	</div>

	@if( !is_null($selectedRole) )
    <div class="form-group m-3 row">
		<label for="personne" class="col-form-label text-md-right">Personne</label>
		<div class="">
			<select wire:model="selectedPersonne" multiple class="form-control form-select-lg" id="personne">
				<option value="null" selected>
					Choisir une personne
				</option>
				@foreach($personnes as $personne)
					<option value="{{$personne->id}}">
						{{$personne->name}} {{$personne->prenom}} ( {{$personne->email}} )
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif
	@if( !is_null($selectedPersonne) )
		<input type="number" name="user_id" class="form-control" value="{{$selectedPersonne[0]}}" hidden>
	@endif
</div>
