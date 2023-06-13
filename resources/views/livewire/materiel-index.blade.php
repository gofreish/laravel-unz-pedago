<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
    	<div class="row">
    		<div class="col-md-2"></div>
    		<select wire:model="selectedTypeMateriel" class="col-md-3">
				@if( is_null($selectedTypeMateriel) )
                    <option value="null" selected>
                        Type du matériel
                    </option>
                @endif
                @forelse($typesMateriel as $typeMateriel)
                	<option value="{{$typeMateriel->id}}">
                    	{{$typeMateriel->type}}
                	</option>
			    @empty
				<p>Auncun type de matériel n'est enregistré</p>
                @endforelse
            </select>
            <div class="col-md-2"></div>
            <div class="col-md-3">
            	<a href="{{ route('materiel.create') }}" class="btn btn-block btn-primary">Créer</a>
            </div>
    		<div class="col-md-2"></div>
		</div>
	</div>

    <div class="card">
       	<div class="card-header">
          	<div class='text-center display-4'>
            	<strong>Matériels {{$type_name}}</strong>
          	</div>
        </div>
        <div class="card-body">
        	<!-- Code pour l affichage -->
        	@if( !is_null($selectedTypeMateriel) )
        	<table class="table table-responsive-sm table-bordered table-striped table-sm">
          		<thead>
            		<tr>
            			<th>Nom</th>
            			<th>Quantité</th>
            			<th>Dernière modification</th>
            			<th></th>
            			<th></th>
            		</tr>
          		</thead>
          		<tbody>
            	@forelse( $materiels as $materiel )
              	<tr>
                	<td> {{$materiel->name}} </td>
                	<td> {{$materiel->quantite}} </td>
                	<td> {{$materiel->updated_at}} </td>
                	<td>
                		<a href="{{ route('materiel.edit',[$materiel->id]) }}" class="btn btn-block btn-primary">Modifier</a>
                	</td>
                	<td>
                		<form method="POST" action="{{ route('materiel.destroy',[$materiel->id]) }}">
                			@csrf
                			@method('DELETE')
                			<button class="btn btn-block btn-danger">Supprimer</button>
                		</form>
                	</td>
              </tr>
            @empty
            <tr> Pas de matériel enregistré </tr>
            @endforelse
          </tbody>
        </table>
        	<!-- Fin -->
        </div>
        <div class='card-footer'>

        </div>
        @endif
     </div>
</div>
