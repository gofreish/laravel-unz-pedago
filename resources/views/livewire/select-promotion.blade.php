<div>
    {{-- Stop trying to control. --}}
    <div class="text-center"> Choix de la Promotion</div>
	<div class="form-group row">
		<label for="filiere" class="col-md-4 col-form-label text-md-right">Filiere</label>
		<div class="col-md-6">
			<select wire:model="selectedFiliere" class="form-control" id="filiere">
				<option value="" selected>
					Choisir une Filiere 
				</option>
				@foreach($filieres as $filiere)
					<option value="{{$filiere->id}}">
						{{$filiere->name}}
					</option>
				@endforeach
			</select>
		</div>	
	</div>
	@if( !is_null($selectedFiliere) )
	<div class="form-group row">
		<label for="promotion" class="col-md-4 col-form-label text-md-right">Promotion</label>
		<div class="col-md-6">
			<select wire:model="selectedPromotion" class="form-control" id="promotion">
				<option value="" selected>
					Choisir une Promotion 
				</option>
				@foreach($promotions as $promotion)
					<option value="{{$promotion->id}}">
						{{$promotion->annee_entrer}}
					</option>
				@endforeach
			</select>
		</div>	
	</div>
	@endif
	@if( !is_null($selectedPromotion) )
		<input type="text" name="promotion" class="form-control" value="{{$selectedPromotion}}" hidden>
	@endif
</div>
