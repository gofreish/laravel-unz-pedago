<div>
    <!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comment importer le PV de délibération rectifié ?</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ol>
                <li>Premièrement télécharger le PV généré par l'application et enregistrez vos modification</li>
                <li>Dans la partie <span class="fw-bold">télécharger un exemplaire de PV</span> renseignez correctement les champs et téléchargez l'exemplaire</li>
                <li>Copiez les informations du PV rectifié dans l'examplaire téléchargé en prêtant attention aux colonnes des modules et enregistrez</li>
                <li>Maintenant importez cet examplaire dans la partie <span class="fw-bold">Importez un PV</span> en renseignant tous les champs</li>
                <li>Cliquez sur <span class="fw-bold">Importez le PV correspondant</span> pour finir</li>
            </ol> 
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
    
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="mb-3 fs-2 fw-bold text-decoration-underline">Recherche de PV de délibération</div>
    <div class="d-flex flex-row">
        <!-- Delib result -->
        @if ( $delibFound )
            <!-- Delib Found -->
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <img style="width: 10%" src="{{asset('assets/icons/smile.svg')}}" alt="smile_icon"> Délibération trouvée. <br>
                    </li>
                    <li class="list-group-item">
                        Cliquez <button wire:click="downloadDeliberation" class="btn btn-success">Ici</button> pour la télécharger.
                    </li>
                    <li class="list-group-item">
                        <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                            Comment importer le PV de délibération rectifié ? 
                        </button>
                        {{-- Fenitre modale du bouton ci-dessus --}}
                        
                        {{-- Fin de la fenitre modale du bouton --}}
                    </li>
                </ul>
            </div>
        @else
            <!-- Delib Not Found -->
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <img style="width: 10%" src="{{asset('assets/icons/sad.svg')}}" alt="">
                        Désolé aucun résultat pour l'instant. Essayer de filtrer<br>
                    </li>
                </ul>
            </div>
        @endif
        <!-- Delib champs -->
        <div class="card" >
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <select wire:model="selectedFiliere" class="form-control">
                        <option value="">Choisir la filiere</option>
                        @forelse ($filieres as $key => $filiere)
                            <option value="{{$filiere->id}}"> {{ $filiere->name }} </option>
                        @empty
                            <option value="">Aucune filiere enregistrée</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedPromotion" class="form-control">
                        <option value="" selected>Choisir la promotion</option>
                        @forelse ($promotions as $key => $promotion)
                            <option value="{{$promotion->id}}"> {{ $promotion->annee_entrer }} </option>
                        @empty
                            <option value="">Aucune promotion enregistrée</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedCycle" class="form-control">
                        <option value="" selected>Choisir le Cycle</option>
                        @forelse ($cycles as $key => $cycle)
                            <option value="{{$cycle->id}}"> {{ $cycle->cycle }} </option>
                        @empty
                            <option value="">Aucun cycle enregistré</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedSemestre" class="form-control">
                        <option value="" selected>Choisir le Semestre</option>
                        @forelse ($semestres as $key => $semestre)
                            <option value="{{$semestre->id}}"> {{ $semestre->intitule }} </option>
                        @empty
                            <option value="">Aucun semestre enregistré</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedSemestre" class="form-control">
                        <option value="1" selected>Choisir la session</option>
                        <option value="1" selected>Session normale</option>
                        <option value="0" selected>Session de rattrapage</option>
                    </select>
                </li>
                <li class="list-group-item">
                    <button wire:click="rechercher" class="btn btn-outline-primary">Rechercher</button>
                </li>
            </ul>
        </div>
    </div>
    <hr class="mt-4">
    <div class="mb-3 fs-2 fw-bold text-decoration-underline">Importation de délibération</div>
    <div class="mb-3 fs-4 fw-bold">
        Description : Cette partie permet d'importer les PV de délibération dans l'application.
        <div class="text-warning">
            Attention utiliser cette fonction avec précaution. En cas de problème, 
            votre responsabilité sera située.
        </div>
    </div>
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
    <div class="d-flex flex-row">
        <!-- Telecharger exemplaire -->
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-secondary">
                    Télécharger un exemplaire de PV
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedFiliereForModel" class="form-control">
                        <option value="">Choisir la filiere</option>
                        @forelse ($filieres as $key => $filiere)
                            <option value="{{$filiere->id}}"> {{ $filiere->name }} </option>
                        @empty
                            <option value="">Aucune filiere enregistrée</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedCycleForModel" class="form-control">
                        <option value="" selected>Choisir le Cycle</option>
                        @forelse ($cycles as $key => $cycle)
                            <option value="{{$cycle->id}}"> {{ $cycle->cycle }} </option>
                        @empty
                            <option value="">Aucun cycle enregistré</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item">
                    <select wire:model="selectedSemestreForModel" class="form-control">
                        <option value="" selected>Choisir le Semestre</option>
                        @forelse ($semestres as $key => $semestre)
                            <option value="{{$semestre->id}}"> {{ $semestre->intitule }} </option>
                        @empty
                            <option value="">Aucun semestre enregistré</option>
                        @endforelse
                    </select>
                </li>
                <li class="list-group-item"><button wire:click="downloadPVHead" class="btn btn-outline-primary">Télécharger le modèle de PV correspondant</button></li>
            </ul>
        </div>
        <!-- Upload -->
        <div class="card" >
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-secondary">Importer un PV</li>
                <form action="{{route('deliberation.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <li class="list-group-item">
                        <select wire:model="selectedFiliereForUpload" class="form-control">
                            <option value="">Choisir la filiere</option>
                            @forelse ($filieres as $key => $filiere)
                                <option value="{{$filiere->id}}"> {{ $filiere->name }} </option>
                            @empty
                                <option value="">Aucune filiere enregistrée</option>
                            @endforelse
                        </select>
                    </li>
                    <li class="list-group-item">
                        <select name="promotion_id" class="form-control" required>
                            <option value="">Choisir la promotion</option>
                            @forelse ($promotionsForModel as $key => $promotion)
                                <option value="{{$promotion->id}}"> {{ $promotion->annee_entrer }} </option>
                            @empty
                                <option value="">Choisir d'abord une filière</option>
                            @endforelse
                        </select>
                    </li>
                    <li class="list-group-item">
                        <select name="cycle_id" class="form-control" required>
                            <option value="" selected>Choisir le Cycle</option>
                            @forelse ($cycles as $key => $cycle)
                                <option value="{{$cycle->id}}"> {{ $cycle->cycle }} </option>
                            @empty
                                <option value="">Aucun cycle enregistré</option>
                            @endforelse
                        </select>
                    </li>
                    <li class="list-group-item">
                        <select name="semestre_id" class="form-control" required>
                            <option value="" selected>Choisir le Semestre</option>
                            @forelse ($semestres as $key => $semestre)
                                <option value="{{$semestre->id}}"> {{ $semestre->intitule }} </option>
                            @empty
                                <option value="">Aucun semestre enregistré</option>
                            @endforelse
                        </select>
                    </li>
                    <li class="list-group-item">
                        <select name="isNormal" class="form-control" required>
                            <option value="" selected>Choisir la Session</option>
                            <option value=1>Session normale</option>
                            <option value=0>Session de rattrapage</option>
                        </select>
                    </li>
                    <li class="list-group-item">
                        <label for="delibDate" class="fw-bold form-label">Date de délibération</label>
                        <input name="delibDate" type="date" class="form-control" id="delibDate">
                    </li>
                    <li class="list-group-item">
                        <input name="pv_delib" type="file" class="form-control" id="inputGroupFile02" required>
                    </li>
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-outline-success">Importer le PV correspondant</button>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</div>
