<div>
    {{-- The whole world belongs to you. --}}
    <div class="fw-bold fs-2">
    </div>
    <div class="d-flex justify-content-center">
        <span class="display-4">Suivre les copies</span>
    </div>
    <div class="row border">
        <!-- Filiere -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Filière</span>
            <select class="form-control" wire:model="selectedFiliere" name="filiere" id="filiere">
                <option value="" selected>Selectionnez la filière</option>
                @foreach ($filieres as $filiere)
                    <option value="{{$filiere->id}}">{{ $filiere->name }}</option>
                @endforeach
            </select>      
        </div>

        <!-- Promotion -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Promotion</span>
            <select class="form-control" wire:model="selectedPromotion" name="filiere" id="filiere">
                <option value="" selected>Selectionnez la promotion</option>
                @foreach ($promotions as $promotion)
                    <option value="{{$promotion->id}}">{{ $promotion->annee_entrer }}</option>
                @endforeach
            </select>      
        </div>

        <!-- Cycle -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Cycle</span>
            <select class="form-control" wire:model="selectedCycle" name="cycle" id="cycle">
                <option value="" selected>Selectionnez le cycle</option>
                @foreach ($cycles as $cycle)
                    <option value="{{$cycle->id}}">{{ $cycle->cycle }}</option>
                @endforeach
            </select>
        </div>

        <!-- Semestre -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Semestre</span>
            <select class="form-control" wire:model="selectedSemestre" name="filiere" id="filiere">
                <option value="" selected>Selectionnez un semestre</option>
                @foreach ($semestres as $semestre)
                    <option value="{{$semestre->id}}">{{ $semestre->intitule }}</option>
                @endforeach
            </select>
        </div>
        
        <!-- Statut -->
        <div class="input-group mb-3">
            <span class="input-group-text">Statut des copies</span>
            <select class="form-control" wire:model="statuCopie" name="statuCopie" id="statuCopie">
                <option value=0 selected>Pas encore sorties</option>
                <option value=1 selected>Déjà sorties mais pas encore de retour</option>
                <option value=2 selected>Déjà retournées</option>
                <option value=3 selected>Déjà notées</option>
            </select>
        </div>

        <div class="d-flex justify-content-center mb-5">
            <button wire:click="rechercher" class="btn btn-outline-primary">Filtrer</button>
        </div>
    </div>

    <div>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col fw-bold fs-italic">Module</th>
                <th scope="col fw-bold fs-italic">Enseignant</th>
                <th scope="col fw-bold fs-italic">Agent</th>
                <th scope="col fw-bold fs-italic">Nombre de copies</th>
                <th scope="col fw-bold fs-italic">Auteur de la sortie</th>
                <th scope="col fw-bold fs-italic">Date de sortie</th>
                <th scope="col fw-bold fs-italic">Date de retour</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($copiesData as $cle => $copie)
                <tr>
                    <td>{{ $copie['nomECU'] }}</td>
                    <td>{{ $copie['prenomEnseignant'] }} {{ $copie['nomEnseignant'] }}</td>
                    <td>{{ $copie['prenomAgent'] }} {{ $copie['nomAgent'] }}</td>
                    <td>{{ $copie['nbr_copie'] }}</td>
                    @if ( !is_null($copie['date_sortie']) )
                        <td>{{ $copie['auteur_sortie'] }}</td>
                        <td>{{ $copie['date_sortie'] }}</td>
                    @else
                        <td>
                            <input wire:model="copiesData.{{$cle}}.auteur_sortie" type="text" placeholder="nom, prenom">
                        </td>
                        <td><button wire:click="sortirCopie({{$cle}})" class="btn btn-primary">Sortir les copies</button></td>
                    @endif
                    @if ( is_null($copie['date_retour']) && !is_null($copie['date_sortie']) )
                        <td><button wire:click="retourCopie({{$cle}})" class="btn btn-primary">Rentrer les copies</button></td>
                    @else
                        <td>{{ $copie['date_retour'] }}</td>
                    @endif
                </tr>
                @empty
                <tr>
                    <th colspan="8" scope="row">VIDE</th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
