<div>
    <?php
        use App\Models\Titre;
    ?>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <form class="form-horizontal" action="{{route('programme.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- ######################################-->
        <!-- Sélection du type de programme -->
        {{-- @can('create', App\Models\Programme::class) --}}
        <div class="form-group row">
            <label for="type_programme" class="col-md-4 col-form-label text-md-right">Type de programme</label>
            <div class="col-md-6">
                <select wire:model="selectedType" class="form-control" id="type_programme">
                    <option value="null" selected>
                        Choisir un type
                    </option>
                    @foreach($types as $type)
                    <option value="{{$type->type}}">
                        {{$type->type}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        {{-- @endcan --}}

        @if( !is_null($selectedType) )
        @if( $selectedType != "AUTRE" )
    <!-- Selection de l'ECU -->
        <!-- ######################################-->
        <!--Choix de La filiere -->
        <div class="form-group row">
            <label for="filiere" class="col-md-4 col-form-label text-md-right">Filiere</label>
            <div class="col-md-6">
                <select wire:model="selectedFiliere" class="form-control" id="filiere" required>
                        <option value="null" selected>
                            Choisir une Filière
                        </option>
                    @foreach($filieres as $filiere)
                        <option value="{{$filiere->id}}">
                            {{$filiere->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    <!-- ######################################-->
        <!--Choix du Cycle -->
    <!-- Si selectedFiliere est non nul alors le champ select a changée de valeur et on a récupérée les cycles -->
    @if( !is_null($selectedFiliere) )
        <div class="form-group row">
        <label for="cycle" class="col-md-4 col-form-label text-md-right">Cycle</label>
        <div class="col-md-6">
            <select wire:model="selectedCycle" class="form-control" id="cycle" required>
                <option value="null" selected>
                    Choisir un Cycle
                </option>
                @foreach($cycles as $cycle)
                    <option value="{{$cycle->id}}">
                        {{$cycle->cycle}}
                    </option>
                @endforeach
            </select>
        </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix du Semestre -->
    <!-- Si selectedCycle est non nul alors le champ select a changée de valeur et on a récupérée les semestres -->
    @if( !is_null($selectedCycle) )
        <div class="form-group row">
        <label for="semestre" class="col-md-4 col-form-label text-md-right">Semestre</label>
        <div class="col-md-6">
            <select wire:model="selectedSemestre" class="form-control" id="semestre" required>
                <option value="null" selected>
                    Choisir un Semestre
                </option>
                @foreach($semestres as $semestre)
                    <option value="{{$semestre->id}}">
                        {{$semestre->intitule}}
                    </option>
                @endforeach
            </select>
        </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix de l'UE -->
    <!-- Si selectedSemestre est non nul alors le champ select a changée de valeur et on a récupérée les UE -->
    @if( !is_null($selectedSemestre) )
        <div class="form-group row">
        <label for="ue" class="col-md-4 col-form-label text-md-right">UE</label>
        <div class="col-md-6">
            <select wire:model="selectedUE" class="form-control" id="ue" required>
                <option value="null" selected>
                    Choisir une UE
                </option>
                @foreach($UEs as $ue)
                    <option value="{{$ue->id}}">
                        {{$ue->nom}}
                    </option>
                @endforeach
            </select>
        </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix de l'ECU -->
    @if( !is_null($selectedUE) )
        <div class="form-group row">
        <label for="ecu" class="col-md-4 col-form-label text-md-right">ECU</label>
        <div class="col-md-6">
            <select wire:model="selectedECU" name="ecu" class="form-control" id="ecu" required>
                <option value="null" selected>
                    Choisir une ECU
                </option>
                @foreach($ECUs as $ecu)
                    <option value="{{$ecu->id}}">
                        {{$ecu->nom}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    <!-- Choix de l'enseignant -->
    @if( !is_null($selectedECU) )
        <div class="form-group row">
        <label for="enseignant" class="col-md-4 col-form-label text-md-right">Enseignant</label>
        <div class="col-md-6">
            <select class="form-control" id="enseignant" name='enseignant' required>
                <option value="null" selected>
                    Enseignant
                </option>
                @foreach($enseignants as $enseignant)
                    <option value="{{$enseignant->id}}">
                        <?php
                        $titre = Titre::find($enseignant->titre_id);
                        echo $titre->titre;
                        ?>
                        {{$enseignant->name}}
                        {{$enseignant->prenom}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

        <!-- Selection de la promotion -->
    @if( !is_null($selectedFiliere) )
    <div class="form-group row">
        <label for="promotion" class="col-md-4 col-form-label text-md-right">Promotion</label>
        <div class="col-md-6">
            <select wire:model="selectedPromotion" name="promotion" class="form-control" id="promotion" required>
                <option value="null" selected>
                    Choisir une Promotion
                </option>
                @foreach($promotions as $promotion)
                    <option value="{{$promotion->id}}">
                        {{$promotion->annee_entrer}}
                    </option>
                @endforeach
            </select>
        </div>
        </div>
    @endif
    @endif {{-- @end if de $selectedType != "AUTRE" --}}
    @endif {{-- @end if de !is_null($selectedType) --}}
		<!-- ######################################-->
		@if( !is_null($selectedType) )
        <!-- Id du type selectionné -->
        <input type="text" name="type" value="{{$selectedTypeId}}" hidden>
		<!-- Date de début -->
        <div class="form-group row">
          	<label class="col-md-4 col-form-label text-md-right" for="debut-input">Date
            @if( $selectedType != "EXAMEN")de début @endif</label>
           	<div class="col-md-6">
            <input class="form-control" id="debut-input" type="date" name="date_debut" placeholder="date de début du cours" required><span class="help-block">Entrez la date
            @if( $selectedType === "COURS")de début du cours @endif</span>
            </div>
        </div>
        <!-- ######################################-->
        <!-- Visible quand c'est pas un examen -->
        @if( $selectedType != "EXAMEN")
        <!-- Date de fin -->
        <div class="form-group row">
        	<label class="col-md-4 col-form-label text-md-right" for="fin-input">Date de fin</label>
            <div class="col-md-6">
                <input class="form-control" id="fin-input" type="date" name="date_fin" placeholder="date de fin du cours"><span class="help-block">Entrez la date de fin</span>
            </div>
        </div>
        @endif
        <!-- ######################################-->
        <!-- Heure de début le matin -->
        <div class="form-group row">
          	<label class="col-md-4 col-form-label text-md-right" for="heure-debut-input">Heure de début matin
            {{--@if( $selectedType === "COURS") matin @endif--}}</label>
            <div class="col-md-6">
            	<input class="form-control" id="heure-debut-input" type="time" name="heure_debut_matin" placeholder="heure de début du cours le matin" {{$isActiveHeure}}><span class="help-block">Entrez l'heure de début
                @if( $selectedType === "COURS") du cours le matin @endif</span>
            </div>
        </div>
        <!-- ######################################-->
        <!-- Heure de fin le matin -->
        @if( $selectedType != "EXAMEN")
        <div class="form-group row">
           	<label class="col-md-4 col-form-label text-md-right" for="heure-fin-input">Heure de fin
            @if( $selectedType != "EXAMEN") matin @endif</label>
            <div class="col-md-6">
                <input class="form-control" id="heure-fin-input" type="time" name="heure_fin_matin" placeholder="heure de fin du cours le matin"><span class="help-block">Entrez l'heure de fin
                @if( $selectedType === "COURS") du cours le matin @endif</span>
            </div>
        </div>
        @endif
        <!-- Heure de début le soir -->
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="heure-debut-soir-input">Heure de début soir</label>
            <div class="col-md-6">
                <input class="form-control" id="heure-debut-soir-input" type="time" name="heure_debut_soir" placeholder="heure de début du cours le soir" {{$isActiveHeure}}><span class="help-block">Entrez l'heure de début du soir</span>
            </div>
        </div>
        <!-- ######################################-->
        <!-- Visible quand ce n est pas un EXAMEN -->
        @if( $selectedType != "EXAMEN")
        <!-- ######################################-->
        <!-- Heure de fin le soir -->
        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="heure-fin-soir-input">Heure de fin soir</label>
            <div class="col-md-6">
                <input class="form-control" id="heure-fin-soir-input" type="time" name="heure_fin_soir" placeholder="heure de fin du cours le soir"><span class="help-block">Entrez l'heure de fin du  soir</span>
            </div>
        </div>
        <!-- #####################################-->
        @livewire('batiment-salle')
        @endif
        <!-- #####################################-->
        <!-- Commentaire -->
        @if( $selectedType === "AUTRE" )
            <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right" for="commentaire">Commentaire</label>
            <div class="col-md-9">
                <textarea class="form-control" id="commentaire" name="commentaire" placeholder="Décrivez l'activité" rows="10"></textarea><span class="help-block">Veuillez décrire ici l'activité</span>
            </div>
        </div>
        @endif
        <!-- #####################################-->
        <div class="card-footer">
          	<button class="btn btn-sm btn-primary" type="submit"> Terminer</button>
            <button class="btn btn-sm btn-danger" type="reset"> Recommencer</button>
        </div>
        @endif
    </form>
</div>
