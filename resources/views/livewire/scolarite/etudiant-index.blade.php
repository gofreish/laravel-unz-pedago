<div>
    {{-- tache : arranger la partie selection des filiere et promotion et la generation du fichier excel 
        Do your work, then step back. --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('erreur'))
        <div class="alert alert-danger">
            {{ session('erreur') }}
        </div>
    @endif
    <div class="row badge bg-secondary fs-1 fw-bolder d-flex justify-content-center">
        Etudiants
    </div>
    <div class="d-flex flex-row">
        <!-- Nouveau -->
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{route('etudiant.create')}}" class="btn btn-outline-primary">
                        <img src="{{asset('assets/icons/plus.svg')}}" alt="plus_icon">
                        Ajouter un étudiant                    
                    </a>
                </li>
                <li class="list-group-item"><button wire:click="downloadListHead" class="btn btn-outline-primary">Télécharger le modèle de liste</button></li>
            </ul>
        </div>
        <!-- Upload -->
        <div class="card" >
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-secondary">Importer une liste d'étudiant</li>
                <li class="list-group-item">
                    Filiere 
                    <select wire:model="selectedFiliere" name="" id="">
                        <option value="">Choisir la filiere</option>
                        @foreach ($filieres as $filiere)
                            <option value="{{$filiere->id}}">{{ $filiere->name }}</option>
                        @endforeach
                    </select>
                </li>
                <form action="{{route('etudiant.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <li class="list-group-item">
                        Promotion
                        <select wire:model="selectedPromotion" name="promotion" id="">
                            <option value="">Choisir la promotion</option>
                            @foreach ($promotions as $promotion)
                                <option value="{{$promotion->id}}">{{ $promotion->annee_entrer }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="list-group-item">
                        Cycle
                        <select wire:model="selectedCycle" name="cycle" id="">
                            <option value="">Choisir le cycle</option>
                            @foreach ($cycles as $cycle)
                                <option value="{{$cycle->id}}">{{ $cycle->cycle }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="list-group-item">
                        <input name="liste" type="file" class="form-control" id="inputGroupFile02" required>
                    </li>
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-outline-success">Importer une liste d'étudiant</button>
                    </li>
                </form>
            </ul>
        </div>
    </div>

    <!-- Recherche d etudiants-->
    <div class="mb-3 fs-2 fw-bold text-decoration-underline">Recherche d'étudiant</div>
    <div class="d-flex flex-row">
        <div class="col-3">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Filière</span>
                <select wire:model="selectedFiliereSearch" name="filiere" class="form-control" id="filiere">
                    <option value="">Filiere</option>
                    @foreach ($filieres as $filiere)
                        <option value="{{$filiere->id}}">{{ $filiere->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Promotion</span>
                <select wire:model="selectedPromotionSearch" name="promotion" class="form-control" id="promotion">
                    <option value="">Promotion</option>
                    @foreach ($promotionsSearch as $promotion)
                        <option value="{{$promotion->id}}">{{ $promotion->annee_entrer }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">INE</span>
                <input wire:model="ine" type="text" class="form-control" placeholder="INE">
            </div> 
            <div class="input-group mb-3">
                <button wire:click="rechercher" class="btn btn-outline-primary">Rechercher</button>
            </div> 
        </div>
        <div class="ms-3 col-9">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>INE</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>née le</th>
                    </tr>
                </thead>
                <tbody class="overflow-auto">
                    @forelse ($etudiants as $etudiant)
                        <tr>
                            <td><a class="btn btn-primary" href="{{route('etudiant.show', ['etudiant'=>$etudiant->ine])}}">Voir</a></td>
                            <td>{{$etudiant->ine}}</td>
                            <td>{{$etudiant->nom}}</td>
                            <td>{{$etudiant->prenom}}</td>
                            <td>{{$etudiant->nee_le}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Vide</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
