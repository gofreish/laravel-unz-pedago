<div>
	<!-- La varibles résutante est:
		$salle
	-->
	<div class="text-center bold"> Choix de la Salle</div>
	<div class="form-group row">
		<label for="batiments" class="col-md-4 col-form-label text-md-right">Bâtiment</label>
		<div class="col-md-6">
			<select wire:model="selectedBatiment" class="form-control">
				<option value="null" selected>
					Choisir un bâtiment
				</option>
				@foreach($batiments as $batiment)
					<option value="{{$batiment->id}}">
						{{$batiment->name}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@if( !is_null($selectedBatiment) )
	<div class="form-group row">
		<label for="salles" class="col-md-4 col-form-label text-md-right">Salle</label>
		<div class="col-md-6">
			<select wire:model="selectedSalle" class="form-control">
				<option value="null" selected>
					Choisir une salle
				</option>
				@foreach($salles as $salle)
					<option value="{{$salle->id}}">
						{{$salle->nom}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif
	@if( !is_null($selectedBatiment) )
		<input type="text" wire:model="selectedSalle" name="salle" class="form-control" value="{{$salle_choisie}}" hidden>
	@endif
</div>
