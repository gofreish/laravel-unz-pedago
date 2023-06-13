<div>
    <?php
        use App\Models\Titre;
    ?>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <form class="form-horizontal" action="{{route('programme.update', ['programme'=>$ID])}}" method="post" enctype="multipart/form-data">
        @csrf
        @if(!auth()->user()->getRoleNames()->contains('scolarite'))
        <input type="text" name="marker" value="modifier" hidden>
        <div class="form-group row">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Type de programme</span></div>
                <select wire:model="selectedType" class="form-control" id="type_programme">
                    <option selected value="{{$donnees['type_programme_id']}}">type</option>
                    @foreach($types as $type)
                    <option value="{{$type->type}}">
                        {{$type->type}}
                    </option>
                    @endforeach
                </select>
                <div class="input-group-append " ><span class="input-group-text" > {{$donnees['type_programme_nom']}}</span></div>
            </div>
        </div>
        @else
        <div class="form-group display-4">
            <input type="text" name="marker" value="scolarite" hidden>
            <div class="input-group-prepend">
                <input class="form-control" id="type-input" type="text" name="type" value="EXAMEN" disabled>
            </div>
        </div>
        @endif

        <!-- ######################################-->
        <!-- Sélection du type de programme -->
        @if(!auth()->user()->getRoleNames()->contains('scolarite'))
        @if( !is_null($selectedType) )
        @if( $selectedType != "AUTRE" )
    <!-- Selection de l'ECU -->
        <!-- ######################################-->
        <!--Choix de La filiere -->

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Filiere
                    </span>
                </div>
                <select wire:model="selectedFiliere" class="form-control" id="filiere">
                    <option value="null" selected></option>
                    @foreach($filieres as $filiere)
                        <option value="{{$filiere->id}}">
                            {{$filiere->name}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['filiere_nom']}}
                    </span>
                </div>
            </div>
        </div>


    <!-- ######################################-->
        <!--Choix du Cycle -->
    <!-- Si selectedFiliere est non nul alors le champ select a changée de valeur et on a récupérée les cycles -->
    @if( !is_null($selectedFiliere) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Cycle
                    </span>
                </div>
                <select wire:model="selectedCycle" class="form-control" id="cycle">
                    <option value="null" selected></option>
                    @foreach($cycles as $cycle)
                        <option value="{{$cycle->id}}">
                            {{$cycle->cycle}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['cycle_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif

    <!-- ######################################-->
        <!--Choix du Semestre -->
    <!-- Si selectedCycle est non nul alors le champ select a changée de valeur et on a récupérée les semestres -->
    @if( !is_null($selectedCycle) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Semestre
                    </span>
                </div>
                <select wire:model="selectedSemestre" class="form-control" id="semestre" >
                    <option value="null" selected></option>
                    @foreach($semestres as $semestre)
                        <option value="{{$semestre->id}}">
                            {{$semestre->intitule}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['semestre_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix de l'UE -->
    <!-- Si selectedSemestre est non nul alors le champ select a changée de valeur et on a récupérée les UE -->
    @if( !is_null($selectedSemestre) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        UE
                    </span>
                </div>
                <select wire:model="selectedUE" class="form-control" id="ue">
                    <option value="null" selected></option>
                    @foreach($UEs as $ue)
                        <option value="{{$ue->id}}">
                            {{$ue->nom}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['u_e_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix de l'ECU -->
    @if( !is_null($selectedUE) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        ECU
                    </span>
                </div>
                <select wire:model="selectedECU" name="ecu" class="form-control" id="ecu">
                    <option selected value="{{$donnees['e_c_u_id']}}"></option>
                    @foreach($ECUs as $ecu)
                        <option value="{{$ecu->id}}">
                            {{$ecu->nom}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['e_c_u_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif

    <!-- Choix de l'enseignant -->
    @if( !is_null($selectedECU) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Enseignant
                    </span>
                </div>
                <select name="enseignant" class="form-control" id="enseignant" name='enseignant'>
                    <option selected value="{{$donnees['enseignant_id']}}"></option>
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['enseignant_titre']}}
                        {{$donnees['enseignant_prenom']}}
                        {{$donnees['enseignant_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif

        <!-- Selection de la promotion -->
    @if( !is_null($selectedFiliere) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Promotion
                    </span>
                </div>
                <select wire:model="selectedPromotion" name="promotion" class="form-control" id="promotion">
                    <option selected value="{{$donnees['promotion_id']}}"></option>
                    @foreach($promotions as $promotion)
                        <option value="{{$promotion->id}}">
                            {{$promotion->annee_entrer}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['promotion_anne']}}
                    </span>
                </div>
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
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Date
            @if( $selectedType != "EXAMEN")de début @endif
                    </span>
                </div>
                <input class="form-control" id="debut-input" type="date" name="date_debut" placeholder="date de début du cours" value="{{$donnees['dateDebut']}}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['dateDebut']}}
                    </span>
                </div>
            </div>
        </div>
        <!-- ######################################-->
        <!-- Visible quand c'est pas un examen -->
        @if( $selectedType != "EXAMEN")
        <!-- Date de fin -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Date de fin
                    </span>
                </div>
                <input class="form-control" id="fin-input" type="date" name="date_fin" placeholder="date de fin du cours" value="{{$donnees['dateFin']}}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['dateFin']}}
                    </span>
                </div>
            </div>
        </div>
        @endif
        <!-- ######################################-->
        <!-- Heure de début le matin -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de début matin
                        @if( $selectedType === "COURS") matin @endif
                    </span>
                </div>
                <input class="form-control" id="heure-debut-input" type="time" name="heure_debut_matin" placeholder="heure de début du cours le matin" value="{{$donnees['h_Deb_Matin']}}" {{$isActiveHeure}}>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['h_Deb_Matin']}}
                    </span>
                </div>
            </div>
        </div>
        <!-- ######################################-->
        <!-- Heure de fin le matin -->
        @if( $selectedType != "EXAMEN")
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de fin
            @if( $selectedType === "COURS") matin @endif
                    </span>
                </div>
                <input class="form-control" id="heure-fin-input" type="time" name="heure_fin_matin" placeholder="heure de fin du cours le matin" value="{{$donnees['h_Fin_Matin']}}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['h_Fin_Matin']}}
                    </span>
                </div>
            </div>
        </div>
        @endif
        <!-- Heure de début le soir -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de début soir
                    </span>
                </div>
                <input class="form-control" id="heure-debut-soir-input" type="time" name="heure_debut_soir" placeholder="heure de début du cours le soir" value="{{$donnees['h_Deb_Soir']}}" {{$isActiveHeure}}>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['h_Deb_Soir']}}
                    </span>
                </div>
            </div>
        </div>

        <!-- ######################################-->
        <!-- Visible quand ce n est pas un EXAMEN -->
        @if( $selectedType != "EXAMEN")
        <!-- ######################################-->
        <!-- Heure de fin le soir -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de fin soir
                    </span>
                </div>
                <input class="form-control" id="heure-fin-soir-input" type="time" name="heure_fin_soir" placeholder="heure de fin du cours le soir" value="{{$donnees['h_Fin_Soir']}}">
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['h_Fin_Soir']}}
                    </span>
                </div>
            </div>
        </div>
        <!-- #####################################-->

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Bâtiment
                    </span>
                </div>
                <select wire:model="selectedBatiment" class="form-control">
                    <option selected></option>
                    @foreach($batiments as $batiment)
                        <option value="{{$batiment->id}}">
                            {{$batiment->name}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['batiment_name']}}
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Salle
                    </span>
                </div>
                <select wire:model="selectedSalle" class="form-control" name="salle_id">
                    <option value="{{$donnees['salle_id']}}" selected></option>
                    @foreach($salles as $salle)
                        <option value="{{$salle->id}}">
                            {{$salle->nom}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['salle_nom']}}
                    </span>
                </div>
            </div>
        </div>

        @endif
        <!-- #####################################-->
        <!-- Commantaire -->
        @if( $selectedType === "AUTRE" )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Commentaire
                    </span>
                </div>
                <textarea class="form-control" id="commentaire" name="commentaire" placeholder="Décrivez l'activité" rows="10"></textarea>
                <div class="input-group-append">
                    <span class="input-group-text">

                    </span>
                </div>
            </div>
        </div>
        @endif
        @endif
        @else
        <!-- #####################################-->
        <!-- scolarité-->

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Filiere
                    </span>
                </div>
                <select wire:model="selectedFiliere" class="form-control" id="filiere" disabled>
                    <option selected></option>
                    @foreach($filieres as $filiere)
                        <option value="{{$filiere->id}}">
                            {{$filiere->name}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['filiere_nom']}}
                    </span>
                </div>
            </div>
        </div>


    <!-- ######################################-->
        <!--Choix du Cycle -->
    <!-- Si selectedFiliere est non nul alors le champ select a changée de valeur et on a récupérée les cycles -->
    @if( !is_null($selectedFiliere) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Cycle
                    </span>
                </div>
                <select wire:model="selectedCycle" class="form-control" id="cycle" disabled>
                    <option selected></option>
                    @foreach($cycles as $cycle)
                        <option value="{{$cycle->id}}">
                            {{$cycle->cycle}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['cycle_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif

    <!-- ######################################-->
        <!--Choix du Semestre -->
    <!-- Si selectedCycle est non nul alors le champ select a changée de valeur et on a récupérée les semestres -->
    @if( !is_null($selectedCycle) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Semestre
                    </span>
                </div>
                <select wire:model="selectedSemestre" class="form-control" id="semestre" disabled>
                    <option selected></option>
                    @foreach($semestres as $semestre)
                        <option value="{{$semestre->id}}">
                            {{$semestre->intitule}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['semestre_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix de l'UE -->
    <!-- Si selectedSemestre est non nul alors le champ select a changée de valeur et on a récupérée les UE -->
    @if( !is_null($selectedSemestre) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        UE
                    </span>
                </div>
                <select wire:model="selectedUE" class="form-control" id="ue" disabled>
                    <option selected></option>
                    @foreach($UEs as $ue)
                        <option value="{{$ue->id}}">
                            {{$ue->nom}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['u_e_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif
    <!-- ######################################-->
        <!--Choix de l'ECU -->
    @if( !is_null($selectedUE) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        ECU
                    </span>
                </div>
                <select wire:model="selectedECU" name="ecu" class="form-control" id="ecu" disabled>
                    <option selected value="{{$donnees['e_c_u_id']}}"></option>
                    @foreach($ECUs as $ecu)
                        <option value="{{$ecu->id}}">
                            {{$ecu->nom}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['e_c_u_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif

    <!-- Choix de l'enseignant -->
    @if( !is_null($selectedECU) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Enseignant
                    </span>
                </div>
                <select name="enseignant" class="form-control" id="enseignant" name='enseignant' disabled>
                    <option selected value="{{$donnees['enseignant_id']}}"></option>
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
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['enseignant_titre']}}
                        {{$donnees['enseignant_prenom']}}
                        {{$donnees['enseignant_nom']}}
                    </span>
                </div>
            </div>
        </div>
    @endif

        <!-- Selection de la promotion -->
    @if( !is_null($selectedFiliere) )
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Promotion
                    </span>
                </div>
                <select wire:model="selectedPromotion" name="promotion" class="form-control" id="promotion" disabled>
                    <option selected value="{{$donnees['promotion_id']}}"></option>
                    @foreach($promotions as $promotion)
                        <option value="{{$promotion->id}}">
                            {{$promotion->annee_entrer}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['promotion_anne']}}
                    </span>
                </div>
            </div>
        </div>

    @endif
    {{-- @end if de $selectedType != "AUTRE" --}}
     {{-- @end if de !is_null($selectedType) --}}
		<!-- ######################################-->

        <!-- Id du type selectionné -->
        <input type="text" name="type" value="{{$selectedTypeId}}" hidden>
		<!-- Date de début -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Date

                    </span>
                </div>
                <input class="form-control" id="debut-input" type="date" name="date_debut" placeholder="date de début du cours" value="{{$donnees['dateDebut']}}" disabled>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['dateDebut']}}
                    </span>
                </div>
            </div>
        </div>
        <!-- ######################################-->
        <!-- Heure de début le matin -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de début matin
                        @if( $selectedType === "COURS") matin @endif
                    </span>
                </div>
                <input class="form-control" id="heure-debut-input" type="time" name="heure_debut_matin" placeholder="heure de début du cours le matin" value="{{$donnees['h_Deb_Matin']}}" {{$isActiveHeure}}>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['h_Deb_Matin']}}
                    </span>
                </div>
            </div>
        </div>
        <!-- Heure de début le soir -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de début soir
                    </span>
                </div>
                <input class="form-control" id="heure-debut-soir-input" type="time" name="heure_debut_soir" placeholder="heure de début du cours le soir" value="{{$donnees['h_Deb_Soir']}}" {{$isActiveHeure}}>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['h_Deb_Soir']}}
                    </span>
                </div>
            </div>
        </div>

        <!-- ######################################-->
        <!-- Visible quand ce n est pas un EXAMEN -->


        <!-- #####################################-->

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Bâtiment
                    </span>
                </div>
                <select wire:model="selectedBatiment" class="form-control">
                    <option selected></option>
                    @foreach($batiments as $batiment)
                        <option value="{{$batiment->id}}">
                            {{$batiment->name}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['batiment_name']}}
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Salle
                    </span>
                </div>
                <select wire:model="selectedSalle" class="form-control" name="salle_id">
                    <option value="{{$donnees['salle_id']}}" selected></option>
                    @foreach($salles as $salle)
                        <option value="{{$salle->id}}">
                            {{$salle->nom}}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$donnees['salle_nom']}}
                    </span>
                </div>
            </div>
        </div>
        <!-- #####################################-->
        <!-- Commentaire -->


        @endif
        <!-- #####################################-->
        <div class="card-footer">
          	<button class="btn btn-sm btn-primary" type="submit" value="put"> Terminer</button>
            <input type="hidden" name="_method" value="put" />
            <button class="btn btn-sm btn-danger" type="reset"> Recommencer</button>
        </div>
    </form>

</div>
