<div>
	<!-- La varibles résutante est:
		$type_programme
	-->
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
	<div class="form-group row">
		<label for="type_programme" class="col-md-4 col-form-label text-md-right">Type de programme</label>
		<div class="col-md-6">
			<select wire:model="selectedType" class="form-control" id="type_programme">
				<option value="null" selected>
					Choisir un type
				</option>
				@foreach($types as $type)
					<option value="{{$type->id}}">
						{{$type->type}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
	@if( !is_null($selectedType) )
		<input type="text" name="type_programme" class="form-control" value="{{$selectedType}}" hidden>
	@endif
</div>
