
    {{-- Success is as dangerous as failure. --}}

    <div class="card">
    	<div class="row">
    		<div class="col-md-2"></div>
    		<select wire:model="selectedFiliere" class="col-md-3">
				<option value="null" selected>
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
    		<div class="col-md-2"></div>
    		<select wire:model="selectedPromotion" class="col-md-3">
				<option value="null" selected>
                    PROMOTION
                </option>
                @forelse($promotions as $promotion)
                	<option value="{{$promotion->id}}">
                    	{{$promotion->annee_entrer}}
                	</option>
				@empty
					<p>Pas de promotion enregistrée</p>
				@endforelse
            </select>
		</div>
	</div>
    <div class="card">
       	<div class="card-header">
          	<div class='text-center display-4'>
            	<strong>Programme</strong>
          	</div>
        </div>
        <div class="card-body">
        	<!-- Code pour l affichage -->
        	@if( !is_null($selectedPromotion) )
              	<h5>
              	UFR Sciences et technologies <br>
              	{{$selectedFiliereName->name}} promotion {{$selectedPromotionAnne->annee_entrer}} <br>
              	Emploi du temps <br>
              	</h5>
        		<table class="table table-responsive-sm table-bordered table-striped table-sm">
          			<thead>
            	<tr>
            		<th>Semaine</th>
            		<th>lundi</th>
            		<th>mardi</th>
            		<th>mercredi</th>
            		<th>jeudi</th>
            		<th>vendredi</th>
            		<th>samedi</th>
            	</tr>
          	</thead>
          	<tbody>
            @forelse( $superProgrammeTab as $lundi => $programme )
              <tr>
                <td>
                  Du {{\Carbon\Carbon::parse( $lundi )->format('d-m-Y')}} au {{ \Carbon\Carbon::parse( $lundi )->endOfWeek()->format('d-m-Y') }}
                </td>
                @foreach( $programme as $jour => $contenu )
                	<td>
                		<?php
                		echo html_entity_decode($contenu)
                		?>
                	</td>
                @endforeach
              </tr>
            @empty
            <tr> Pas de programme disponible </tr>
            @endforelse
          </tbody>
        </table>
        	<!-- Fin -->
        </div>
        <div class='card-footer'>
        	<strong>NB : </strong>Ce programme est susceptible d'être modifié. Veuillez consulter régulièreme le programme.<br>
        	<blockquote class="blockquote text-right">
        	<strong class='text-right'>{{$coordonateur['titre']}} {{$coordonateur['prenom']}} {{$coordonateur['nom']}}</strong>
        	</blockquote>
        </div>
        @endif
     </div>
