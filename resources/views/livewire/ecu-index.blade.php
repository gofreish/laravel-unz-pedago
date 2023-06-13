<div>
    {{-- The whole world belongs to you. --}}

    <div class="card">
    	@if(Session::has('message'))
      		<div class="row">
        		<div class="col-12">
          		<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        		</div>
      		</div>
    	@endif
    	<div class="row">
    		<!-- Filiere -->
    		<select wire:model="selectedFiliere" class="col">
                <option value='null' selected>
                    FILIÈRE
                </option>
                @forelse($filieres as $filiere => $id)
                	<option value="{{$id}}">
                    	{{$filiere}}
                	</option>
			    @empty
				<p>Pas de filière enregistrée</p>
                @endforelse
            </select>
            <!-- Cycle -->
            <select wire:model="selectedCycle" class="col">
				    <option value='null'  selected>
                        Cycle
                    </option>
                @forelse($cycles as $cycle)
                	<option value="{{$cycle->id}}">
                    	{{$cycle->cycle}}
                	</option>
			    @empty
				<p>Pas de Cycle disponible pour cette filiere</p>
                @endforelse
            </select>
    		<!-- Semestre -->
    		<select wire:model="selectedSemestre" class="col">
				@if( is_null($selectedSemestre) )
                    <option value="" selected>
                        Semestre
                    </option>
                @endif
                @forelse($semestres as $semestre)
                	<option value="{{$semestre->id}}">
                    	{{$semestre->intitule}}
                	</option>
				@empty
					<p>Pas de semestre disponible pour ce cycle</p>
				@endforelse
            </select>
		</div>
	</div>

	@if( !is_null($tableau) )
	<div class="card">
      <div class="card-header">
      	<a href="{{route('ecu.create')}}"> <button class="btn btn-primary">Ajout</button> </a>
        @if($contain)
            <form action="{{route('ecu.pdf')}}" method="post">
                @csrf
                <input type="hidden" name="html" value="{{$html}}">
                <input type="hidden" name="pdfName" value="{{$pdfName}}">
                <button type="submit" class="btn btn-success">Telecharger</button>
            </form>
        @endif
        <div class="display-4">
        	<span class="badge bg-secondary">
            	<strong><i class="cil-book">
            	{{$selectedSemestreName}} {{$selectedFiliereName}}
            	</i></strong>
        	</span>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>UE</th>
              <th>Crédits</th>
              <th>VH</th>
              <th>Code EC</th>
              <th>EC</th>
              <th>Coefficient</th>
              <th>VHF</th>
              <th>VHA</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
              @forelse( $tableau as $cle => $ue )
              	@foreach($ue['ec'] as $key => $ecu)
              	<tr>
              		<td>{{$ue['nom']}}</td>
              		<td>{{$ue['credit']}}</td>
              		<td>{{$ue['VH']}}</td>
              		<td>{{$ecu['code']}}</td>
              		<td>{{$ecu['nom']}}</td>
              		<td>{{$ecu['coefficient']}}</td>
              		<td>{{$ecu['VHF']}}</td>
              		<td>{{$ecu['VHA']}}</td>
              		<td>
              			<form method="POST" action="{{route('ecu.destroy', ['ecu' => $ecu['id']])}}">
						@csrf
            			<button class="btn btn-block btn-danger" onclick="return confirm('Cet ECU sera supprimer');" type="submit" value="Delete">
                			Supprimer
            			</button>
            			<input type="hidden" name="_method" value="delete" />
						</form>
              		</td>
              	</tr>
              	@endforeach
              @empty
              <tr> VIDE </tr>
              @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer">

      </div>
    </div>
    @endif
</div>
