<div>
    {{-- In work, do what you enjoy. --}}
    <div class="row mb-4">
        <div class="col border">
            <ol>
                <li> <h4>
                    <select wire:model="isNormal" @if ($sessionConfirmed) disabled @endif>
                        <option value="">Choisir la session du devoir</option>
                        <option value=1>Session normale</option>
                        <option value=0>Session de rattrapage</option>
                    </select>
                    <button wire:click="confirmSession" class="btn btn-success" @if ($sessionConfirmed) disabled @endif>Confirmer</button>
                </h4></li>
                <li> <h4>
                    Changer la date du devoir : 
                    <input wire:model="dateDevoir" type="date">
                    <button wire:click="changeDate" class="btn btn-secondary">
                        Enregistrer
                    </button>
                </h4></li>
                <li class="mt-4"><h4>
                    <div>
                        Changer les heures du devoir
                    </div>
                    <div><span>
                        Début <input wire:model="hDebDev" type="time">
                        Fin <input wire:model="hFinDev" type="time">
                        <button wire:click="changeHeure" class="btn btn-secondary">
                            Enregistrer
                        </button>
                    </span></div>
                </h4></li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($sessionConfirmed)
                <h5 class="card-title text-center fs-3 fw-bolder"> {{$newStudentsNbr}} Nouveaux et {{$oldStudentsNbr}} Anciens composent cette evaluation</h5>
            @else
                <h5 class="card-title text-center fs-3 fw-bolder"> Veuillez confirmer le choix de la session</h5>    
            @endif
            <h6 class="card-subtitle mb-2 text-center fs-4 text-muted text-decoration-underline">Création des groupes (il reste {{ $studentRestant }} étudiants sans groupe)</h6>
            <div class="d-flex flex-row">
                <!-- Cote gauche -->
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <!-- Les groupes-->
                            <select wire:model="group_id" id="groupe" class="form-control" name="surveillant" id="surveillant">
                                <option value="">Choisir le groupe</option>
                                @forelse ($groupeList as $id => $groupe)
                                    <option value="{{$id}}">Groupe {{ $groupe['numero'] }}</option>
                                @empty
                                    <option value="">to delete</option>   
                                @endforelse
                            </select>
                        </li>
                        <li class="list-group-item">
                            <!-- Les salles -->
                            <select wire:model="selectedBat" id="batiment" class="form-control" name="surveillant">
                                <option value="">Choisir le bâtiment</option>
                                @forelse ($batimentList as $batiment)
                                    <option value="{{$batiment->id}}">{{ $batiment->name }}</option>
                                @empty
                                    <option value="">Aucun bâtiment enregistrer</option>
                                @endforelse
                            </select>
                            <select wire:model="selectedSalle" class="form-control" name="surveillant">
                                <option value="">Choisir la salle</option>
                                @forelse ($salleList as $salle)
                                    <option value="{{$salle->id}}">{{ $salle->nom }}</option>
                                @empty
                                    <option value="">Choisir le bâtiment</option>
                                @endforelse
                            </select>
                        </li>
                        <li class="list-group-item">
                            <!-- Les surveillants-->
                            <select wire:model="selectedSurv" class="form-control" name="surveillant" id="surveillant">
                                <option value="">Choisir un surveillant</option>
                                @forelse ($surveillantList as $surveillant)
                                    <option value="{{$surveillant->cnib}}">{{ $surveillant->nom }} {{ $surveillant->prenom }}</option>
                                @empty
                                    <option value="">Aucun surveillant enregistrer</option>
                                @endforelse
                            </select>
                        </li>
                        <li class="list-group-item">
                            <!-- Enregistrer la repartition -->
                            <button wire:click="enregistrerRepartition" class="btn btn-success">Enregistrer la repartition</button>
                            @if ( !is_null($successMessage) )
                            <span class="text-success">{{ $successMessage }}</span>
                            @endif
                            @if ( !is_null($errorMessage) )
                            <span class="text-danger">{{ $errorMessage }}</span>
                            @endif
                        </li>
                        @if ( !is_null($successMessage) )
                        <li class="list-group-item">
                            <button wire:click="telechargerRepartition" class="btn btn-primary">Télécharger la repartition</button>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- Cote droit -->
                <div class="card ms-3">
                    <div class="card-body">
                        <div class="card-title text-center"> 
                            <button wire:click="addGroup" class="btn btn-outline-primary">
                                <img src="{{asset('assets/icons/plus.svg')}}" alt="plus_icon">
                                Ajouter un groupe
                            </button>
                            <button wire:click="suppGroupe" class="btn btn-outline-danger">
                                <img src="{{asset('assets/icons/trash.svg')}}" alt="supprimer">
                                Supprimer un groupe
                            </button>
                        </div>
                        <div class="row row-cols-3">
                            @foreach ($groupeList as $id => $groupe)
                                <div class="card me-2 mt-2" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Groupe {{ $groupe['numero'] }}
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            Nombre d'étudiants : 
                                            <input wire:model="groupeList.{{$id}}.taille" type="number" onkeypress="return event.charCode >=49" min="1">
                                        </h6>
                                        <span>
                                            Salle : 
                                            @if ( isset($groupe['salle']['nom'] ) )
                                                {{ $groupe['salle']['nom'] }}
                                                <button wire:click="suppSalle({{$id}})" class="btn btn-outline-danger"><img src="{{asset('assets/icons/trash.svg')}}" alt="supprimer"></button>
                                            @else
                                                vide
                                            @endif
                                        </span>
                                        <br>
                                        <span>Liste des surveillants 
                                            @if ( isset($groupe['surv']['nom'] ) )
                                                <button wire:click="suppSurv({{$id}})" class="btn btn-outline-danger"><img src="{{asset('assets/icons/trash.svg')}}" alt="supprimer"></button>
                                            @endif
                                        </span>
                                        <ul>
                                            @forelse ($groupe['surv'] as $surv)
                                                <li>{{$surv['nom']}} {{$surv['prenom']}}</li>
                                            @empty
                                                Aucun
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
