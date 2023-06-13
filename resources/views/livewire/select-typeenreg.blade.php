<div>
	<!-- La varibles résutante est:
		$type_enregistrement
	-->
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="form-group row">
		<label for="type_enregistrement" class="col-md-4 col-form-label text-md-right">Type d'enregistrement</label>
		<div class="col-md-6">
			<select wire:model="selectedType" class="form-control" id="type_enregistrement">
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
		<input type="text" name="type_enregistrement" class="form-control" value="{{$selectedType}}" hidden>
	@endif
</div>
