<div>
    {{-- The whole world belongs to you. --}}
    <div class="card">
    	<div class="row">

    		<select wire:model="selectedTypeMateriel" class="col">
				<option value="null" selected>
                    Type du matériel
                </option>
                @forelse($typesMateriel as $typeMateriel)
                	<option value="{{$typeMateriel->id}}">
                    	{{$typeMateriel->type}}
                	</option>
			    @empty
				<p>Auncun type de matériel n'est enregistré</p>
                @endforelse
            </select>

            <select wire:model="selectedMateriel" class="col">
				<option value="null" selected>
                    Matériel
                </option>
                @forelse($materiels as $materiel)
                	<option value="{{$materiel->id}}">
                    	{{$materiel->name}}
                	</option>
			    @empty
				<p>Auncun matériel n'est enregistré</p>
                @endforelse
            </select>

            <div class="col">
            	<label for="debut">Début</label>
    			<input wire:model="selectedDebut" type="date" name="debut" id="debut" placeholder="Date de début">
            </div>

    		<div class="col">
    			<label for="debut">Fin</label>
    			<input wire:model="selectedFin" type="date" name="fin" id="fin" placeholder="Date de fin">
    		</div>

    		<div class="col">
    			<form method="POST" action="{{route('statistiques')}}">
            		@csrf
            		<input type="text" name="materiel_id" value="{{$selectedMateriel}}" hidden>
            		<input type="text" name="debut" value="{{$selectedDebut}}" hidden>
            		<input type="text" name="fin" value="{{$selectedFin}}" hidden>
    				<button type="submit" class="btn btn-primary">Obtenir les statistiques</button>
    			</form>
    		</div>

		</div>
	</div>

    <div class="card">
       	<div class="card-header">
          	<div class='text-center display-4'>
            	<strong>Statistiques de {{$materiel_name}}</strong>
          	</div>
        </div>
        <div class="card-body">
        	<!-- Code pour l affichage -->

        	<!-- Fin -->
        </div>
        <div class='card-footer'>

        </div>
     </div>

</div>
