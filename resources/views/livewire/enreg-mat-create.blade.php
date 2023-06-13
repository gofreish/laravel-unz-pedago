
<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <form class="form-horizontal" action="{{route('enregMat.store')}}" method="post">
        @csrf

        <!-- ######################################-->
        <!-- Type du  materiel  -->
        <div class="form-group row">
            <label for="type_materiel" class="col-md-4 col-form-label text-md-right">Type du materiel</label>
            <div class="col-md-6">
                <select wire:model="selectedTypeMat" class="form-control" id="type_materiel" name="type_materiel">
                	@if( is_null($selectedTypeMat) )
                        <option value="1" selected></option>
                    @endif
                    @forelse($typesMat as $type)
                    <option value="{{$type->id}}">
                        {{$type->type}}
                    </option>
                    @empty
                    <option selected>Aucun type enregistré</option>
                    @endforelse
                </select>
            </div>
        </div>

        @if( !is_null($selectedTypeMat) )
        <!-- Liste des materiels -->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Matériel
                    </span>
                </div>
                <select wire:model="selectedMateriel" class="form-control" id="materiel" name="materiel_id" required>
                    <option value="1" selected></option>
                    @forelse($materiels as $materiel)
                    <option value="{{$materiel->id}}">
                        {{$materiel->name}}
                    </option>
                    @empty
                    	Aucun matériel enregistré
                    @endforelse
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        {{$quantite}} restant
                    </span>
                </div>
            </div>
        </div>
        <input type="number" name="quantite_avant_enreg" value="{{$quantite}}" hidden>
        @endif

        @if( !is_null($selectedMateriel) )
        <!-- Selection de l'action a enregistrer ( le type d enregistrement ) -->
        <div class="form-group row">
            <label for="type_materiel" class="col-md-4 col-form-label text-md-right">Action</label>
            <div class="col-md-6">
                <select wire:model="selectedTypeEnreg" class="form-control" id="type_enreg" name="typeEnreg">
                    <option value="1" selected></option>
                    @forelse($typesEnreg as $type)
                    <option value="{{$type->id}}">
                        {{$type->type}}
                    </option>
                    @empty
                    <option selected>Aucune action pré-enregistrée</option>
                    @endforelse
                </select>
            </div>
        </div>

        <!-- Quantité  -->
        <div class="form-group row">
            <label for="quantite" class="col-md-4 col-form-label text-md-right">Quantité</label>
            <div class="col-md-6">
                <input wire:model="selectedQuantite" class="form-control" id="quantite" type="number" name="quantite" placeholder="00" required>
            </div>
            @if( $selectedTypeEnreg == 2 && $selectedQuantite > $quantite )
            	<span class="text-danger">QUANTITÉ INSUFFISANTE</span>
            @endif
        </div>

        <!-- Utilisateur -->
        <div class="form-group row">
            @livewire('select-user')
        </div>

        <div class="form-group row">
        	<div class="col-md-6"> </div>
            <div class="col-md-6">
            	@if( $selectedTypeEnreg != 2 || $selectedQuantite <= $quantite )
                <button class="btn btn-sm btn-primary" type="submit"> Terminer</button>
                @endif
            <button class="btn btn-sm btn-danger" type="reset"> Recommencer</button>
            </div>
        </div>
        @endif

	</form>

</div>
