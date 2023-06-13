<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h4 class="text-decoration-underline fw-bold text-center">
        Enregistrement des copies et PV de surveillance
    </h4>

    <div class="row d-flex justify-content-center">
        <div class="card m-4" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $nomECU }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Date : {{ $dateEvaluation }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Débuté à : {{ $debutEvaluation }}</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Promotion : {{ $promotion }}</li>
                    <li class="list-group-item">Enseignant : {{ $enseignant }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($groupesArray as $key => $groupeArray)
            <!-- Afichage d un groupe -->
            <div class="card mb-5" >
                <div class="card-body">
                    <h5 class="card-title fs-3 text-center text-decoration-underline fw-bold">{{ $groupeArray['nom'] }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> 
                        <span class="fw-bold text-decoration-underline"> Bâtiment</span> : {{ $groupeArray['salle']['nomBat'] }} 
                        <span class="fw-bold text-decoration-underline">Salle</span> : {{ $groupeArray['salle']['nom'] }}
                    </li>
                    <li class="list-group-item">
                        Taille du groupe : {{ $groupeArray['taille'] }}
                    </li>
                    <li class="list-group-item">
                        Nombre de copies : 
                        <input wire:model="groupesArray.{{$key}}.nbr_copie" type="number" onkeypress="return event.charCode >=49" min="1">
                    </li>
                    <li class="list-group-item">
                        <span class="input-group-text">Commentaire</span>
                        <textarea wire:model="groupesArray.{{$key}}.commentaire" class="form-control" aria-label="Commentaire" rows='3' cols='50' >RAS</textarea>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold text-decoration-underline text-center"> Liste des surveillants </span>
                        <table class="table">
                            <caption>Liste des surveillants</caption>
                            <thead>
                                <tr>
                                    <th scope='col'>CNIB</th>
                                    <th scope='col'>Nom</th>
                                    <th scope='col'>Prénom</th>
                                    <th scope='col'>Absence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupeArray['surveillants'] as $cle => $surv)
                                    <tr>
                                        <th>{{ $surv['cnib'] }}</th>
                                        <th>{{ $surv['nom'] }}</th>
                                        <th>{{ $surv['prenom'] }}</th>
                                        <th><input wire:model='groupesArray.{{$key}}.surveillants.{{$cle}}.absent' type="checkbox"></th>
                                    </tr>
                                @empty
                                    <tr> <th colspan='4'>Vide</th> </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold text-decoration-underline text-center"> Liste des étudiants </span>
                        <table class="table">
                            <caption>Liste des étudiants</caption>
                            <thead>
                                <tr>
                                    <th scope='col'>INE</th>
                                    <th scope='col'>Nom</th>
                                    <th scope='col'>Prénom</th>
                                    <th scope='col'>Absence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupeArray['students'] as $cle => $stu)
                                    <tr>
                                        <th>{{$stu['ine']}}</th>
                                        <th>{{ $stu['nom'] }}</th>
                                        <th>{{ $stu['prenom'] }}</th>
                                        <th><input wire:model='groupesArray.{{$key}}.students.{{$cle}}.absent' type="checkbox"></th>
                                    </tr>
                                @empty
                                    <tr> <th colspan='4'>Vide</th> </tr>
                                @endforelse 
                            </tbody>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
        @empty
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">Erreur il n y a aucun groupe enregistré</h5>
                </div>
            </div>
        @endforelse
        
    </div>

    <div class="d-flex justify-content-center mb-5">
        <button wire:click="terminer" class="btn btn-success">Terminer</button>
    </div>
</div>
