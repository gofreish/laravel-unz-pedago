<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div class="row d-flex justify-content-center mb-5">
        <span class="fs-2 fw-bold text-decoration-underline">Les évaluations disponible</span>
    </div>
    <div class="d-flex flex-row">
        <!-- Les champs de selections -->
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <select class="form-control" wire:model="selectedFiliere" name="filiere" id="filiere">
                        <option value="" selected>Choisir la filière</option>
                        @foreach ($filieres as $filiere)
                            <option value="{{$filiere->id}}">{{ $filiere->name }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">
                    <select class="form-control" wire:model="selectedCycle" name="cycle" id="cycle">
                        <option value="" selected>Choisir le cycle</option>
                        @foreach ($cycles as $cycle)
                            <option value="{{$cycle->id}}">{{ $cycle->cycle }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">
                    <select class="form-control" wire:model="selectedSemestre" name="filiere" id="filiere">
                        <option value="" selected>Choisir semestre</option>
                        @foreach ($semestres as $semestre)
                            <option value="{{$semestre->id}}">{{ $semestre->intitule }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">
                    <button wire:click="rechercherEvaluation" class="btn btn-outline-primary">
                        Filtrer
                    </button>
                </li>
            </ul>
        </div>
        <div class="row row-cols-3 ms-3">
            @forelse ($devoirs as $devoir)
                <div class="card ms-3" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item fw-bold">
                            {{ $devoir['nom_ecu'] }}
                        </li>
                        <li class="list-group-item text-secondary">
                            {{ $devoir['date'] }}
                        </li>
                        <li class="list-group-item">
                            Promotion {{ $devoir['promotion'] }}
                        </li>
                        <li class="list-group-item">
                            Enseignant : <span class="badge bg-secondary">{{ $devoir['enseignant'] }}</span>
                        </li>
                        <!-- Si l evaluation a deja ete composée alors -->
                        @if ( $devoir['is_composer'])
                            <li class="list-group-item badge bg-success">
                                Déja évalué
                            </li>
                        @else
                            @if ( $devoir['is_public'] )
                                <li class="list-group-item badge bg-success">
                                    Déjà publié
                                </li>
                            @else
                                <li class="list-group-item badge bg-danger">
                                    Non publié
                                </li>
                            @endif
                            @if ( $devoir['is_prepare'] )
                                <li class="list-group-item badge bg-success">
                                    Déjà préparé
                                </li>
                            @else
                                <li class="list-group-item badge bg-danger">
                                    Non préparé
                                </li>
                            @endif
                            <li class="list-group-item">
                                <a href="{{route('evaluation.show', ['id'=>$devoir['programme_id']])}}" class="btn btn-outline-primary">
                                    <img src="{{ asset('assets/icons/cursor.svg') }}" alt="cursor_icon">
                                    @if ( $devoir['is_prepare'] )
                                        Reprogrammer
                                    @else
                                        Programmer
                                    @endif
                                </a>
                            </li>
                            @if ( $devoir['is_prepare'] )
                                <li class="list-group-item">
                                    <a href="{{route('copies.show', ['id'=>$devoir['programme_id']])}}" class="btn btn-outline-primary">
                                        <img src="{{ asset('assets/icons/paperclip.svg') }}" alt="epingle_icon">
                                        Copies et PV
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            @empty
                <div class="card" style="width: 18rem;">
                    VIDE
                </div>
            @endforelse
        </div>
    </div>
</div>
