<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card">
    	<div class="row">
    		<div class="col">
    			<label for="debut"><span class="badge badge-secondary">Début</span></label>
    			<input wire:model='debut' id="debut" type="date" name="debut" placeholder="Date de début">
    		</div>

    		<div class="col">
    			<label for="fin"><span class="badge badge-secondary">Fin</span></label>
    		<input wire:model='fin' id="fin" type="date" name="fin" placeholder="Date de fin">
    		</div>

    		<div class="col">
    			<label for="achever"><span class="badge badge-secondary">Filtre</span></label>
    			<select wire:model="achever" class="form-control" id="achever" name="achever">
    				<option value="tous" selected> Tous </option>
                	<option value="TRUE"> Achevé </option>
                    <option value="FALSE"> En cour </option>
                </select>
    		</div>

    		<div class="col">
    			<button wire:click="$emit('afficher')" class="btn btn-primary">Afficher</button>
    		</div>

			<div class="col">
				<a href="{{route('enregMat.create')}}">
    				<button class="btn btn-primary">
    					<i class="cil-plus">
    						Nouvelle ligne
    					</i>
    				</button>
    			</a>
    		</div>
		</div>
	</div>

	@if( !is_null($enregistrements) )
	<div class="card">
      <div class="card-header">
        <div class="display-4">
        	<span class="badge bg-secondary">
            	<strong><i class="cil-book">
            	Cahier de suivi du matériel
            	</i></strong>
        	</span>
        </div>
        <div>
        	<span class="badge bg-secondary">
        	<h1>
        	@if( !is_null($debut) )
        		@if( !is_null($fin) )
        			Enregistrement du {{$debut}} au {{$fin}}
        		@else
        			Enregistrement à partir du {{$debut}}
        		@endif
        	@else
        		@if( !is_null($fin) )
        			Enregistrement jusqu'au {{$fin}}
        		@else
        			Tous les enregistrements
        		@endif
        	@endif
        	</h1>
        	</span>
        </div>
        <div>
        	Pages( {{$perPage}} par page ) :
      		@for($i=1; $i<=$numberOfPage; $i++)
      			<span>
      				<button wire:click="$emit('page', {{$i}})" class="btn btn-primary">
      					{{$i}}
      				</button>
      			</span>
      		@endfor
        </div>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>Action</th>
              <th>Matériel</th>
              <th>Quantité</th>
              <th>Auteur</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            @forelse( $enregistrements as $enregistrment )
              {{-- Si c est un tableau --}}
              @if( is_array($enregistrment) )
              <tr>
                <td>{{$enregistrment['date']}}</td>
                <td>
                  @if( $enregistrment['typeEnregId'] == 1 )
                    <span class="badge badge-pill bg-success">
                      {{$enregistrment['type']}}
                    </span>
                  @elseif( $enregistrment['typeEnregId'] == 2 )
                    <span class="badge badge-pill bg-warning">
                      {{$enregistrment['type']}}
                    </span>
                  @else
                    <span class="badge badge-pill bg-secondary">
                      {{$enregistrment['type']}}
                    </span>
                  @endif
                </td>
                <td>{{$enregistrment['materiel']}}</td>
                <td>{{$enregistrment['quantite']}}</td>
                <td>{{$enregistrment['titre']}} {{$enregistrment['name']}} {{$enregistrment['prenom']}}</td>
                <th>
                  @if( $enregistrment['achever'] )
                    <span class="badge badge-pill bg-success">Achevé</span>
                  @else
                    <span class="badge badge-pill bg-warning">En cours</span>
                  @endif
                </th>
              </tr>
              @else
              <tr>
                <td>{{$enregistrment->date}}</td>
                <td>
                  @if( $enregistrment->typeEnregId == 1 )
                    <span class="badge badge-pill bg-success">
                      {{$enregistrment->type}}
                    </span>
                  @elseif( $enregistrment->typeEnregId == 2 )
                    <span class="badge badge-pill bg-warning">
                      {{$enregistrment->type}}
                    </span>
                  @else
                    <span class="badge badge-pill bg-secondary">
                      {{$enregistrment->type}}
                    </span>
                  @endif
                </td>
                <td>{{$enregistrment->materiel}}</td>
                <td>{{$enregistrment->quantite}}</td>
                <td>{{$enregistrment->titre}} {{$enregistrment->name}} {{$enregistrment->prenom}}</td>
                <th>
                  @if( $enregistrment->achever )
                    <span class="badge badge-pill bg-success">Achevé</span>
                  @else
                    <span class="badge badge-pill bg-warning">En cours</span>
                  @endif
                </th>
              </tr>
              @endif
            @empty
            <tr> LE CAHIER EST VIDE </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer">

      	Pages( {{$perPage}} par page ) :
      	@for($i=1; $i<=$numberOfPage; $i++)
      		<span>
      			<button wire:click="$emit('page', {{$i}})" class="btn btn-primary">
      				{{$i}}
      			</button>
      		</span>
      	@endfor
      </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="display-4"> VIDE </div>
        </div>
    </div>
    @endif

</div>
