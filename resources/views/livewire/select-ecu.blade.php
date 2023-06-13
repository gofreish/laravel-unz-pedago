<div>
	<!-- La variable résutante est:
		$ecu
	-->
    {{-- Do your work, then step back. --}}
    <div class="text-center bold"> Choix de l ECU</div>
    <div class="form-group row">

		<label for="filiere" class="col-md-4 col-form-label text-md-right">Filiere</label>
		<div class="col-md-6">
			<select wire:model="selectedFiliere" class="form-control" id="filiere">
                <option value="null" selected>
					Choisir une Filière
				</option>
				@foreach($filieres as $filiere)
					<option value="{{$filiere->id}}">
						{{$filiere->name}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	<!-- Si selectedFiliere est non nul alors le champ select a changée de valeur et on a récupérée les cycles -->
	@if( !is_null($selectedFiliere) )
		<div class="form-group row">
		<label for="cycle" class="col-md-4 col-form-label text-md-right">Cycle</label>
		<div class="col-md-6">
			<select wire:model="selectedCycle" class="form-control" id="cycle">
                <option value="null" selected>
					Choisir un Cycle
				</option>
				@foreach($cycles as $cycle)
					<option value="{{$cycle->id}}">
						{{$cycle->cycle}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif

	<!-- Si selectedCycle est non nul alors le champ select a changée de valeur et on a récupérée les semestres -->
	@if( !is_null($selectedCycle) )
		<div class="form-group row">
		<label for="semestre" class="col-md-4 col-form-label text-md-right">Semestre</label>
		<div class="col-md-6">
			<select wire:model="selectedSemestre" class="form-control" id="semestre">
				<option value="null" selected>
					Choisir un Semestre
				</option>
				@foreach($semestres as $semestre)
					<option value="{{$semestre->id}}">
						{{$semestre->intitule}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif

	<!-- Si selectedSemestre est non nul alors le champ select a changée de valeur et on a récupérée les UE -->
	@if( !is_null($selectedSemestre) )
		<div class="form-group row">
		<label for="ue" class="col-md-4 col-form-label text-md-right">UE</label>
		<div class="col-md-6">
			<select wire:model="selectedUE" class="form-control" id="ue">
				<option value="null" selected>
					Choisir une UE
				</option>
				@foreach($UEs as $ue)
					<option value="{{$ue->id}}">
						{{$ue->nom}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif

    @if( !is_null($selectedUE) )
		<div class="form-group row">
		<label for="ecu" class="col-md-4 col-form-label text-md-right">ECU</label>
		<div class="col-md-6">
			<select wire:model="selectedECU" class="form-control" id="ecu">
				<option value="null" selected>
					Choisir une ECU
				</option>
				@foreach($ECUs as $ecu)
					<option value="{{$ecu->id}}">
						{{$ecu->nom}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@endif
	@if( !is_null($selectedECU) )
		<input type="text" name="ecu" value="{{$ECUchoisi}}" hidden>
	@endif
</div>
