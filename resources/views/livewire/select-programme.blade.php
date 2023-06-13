<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="form-group row">
		<label for="programme" class="col-md-4 col-form-label text-md-right">Programme</label>
		<div class="col-md-6">
			<select wire:model="selectedType" class="form-control" id="programme">
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
