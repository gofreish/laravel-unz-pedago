@extends('unz_st.acceuil.base')
@section('title')
    Ajout de materiel
@endsection
@section('content')
<?php
use App\Models\TypeMateriel;
	$types = TypeMateriel::all();
?>

   <div>
          <a href="{{route('materiel.index')}}">
            <button class="btn btn-lg btn-dark btn-pill "> <i class=" cil-arrow-circle-left "></i></button>
          </a>
     </div>

  <div class="row">
  <div class="col-md-3"></div>

        <div>
            <x-Error/>
        </div>
    <div class="col-md-6 text-center">
        <div class="card">
        	<form class="form-horizontal" action="{{route('materiel.store')}}" method="POST">
        		@csrf
        		<div class="card-header"><strong>Création</strong> de matériel</div>
            	<div class="card-body">
					<!-- Le nom -->
					<div class="form-group row">
						<label class="col-md-3 col-form-label" for="nom">Nom</label>
                    	<div class="col-md-9">
                        <input class="form-control" id="nom" type="text" name="name" placeholder="nom du matériel" required ><span class="help-block">Mettez ici le nom du matériel</span>
                        </div>
                    </div>
                    <!-- La quantité -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="quantite">Quantité</label>
                        <div class="col-md-9">
                        <input class="form-control" id="quantite" type="number" name="quantite" placeholder="00" required><span class="help-block">La quantité initiale du matériel</span>
                        </div>
                    </div>
                    <!-- Type du matériel -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="type">Type</label>
                        <div class="col-md-9">
                        <select class="form-control" id="type" name="type_materiel_id" required>
                        	<option selected></option>
                        	@forelse($types as $type)
                        	<option value="{{$type->id}}">{{$type->type}}</option>
                        	@empty
                        	Aucun type enregistré
                        	@endforelse
                        </select>
                        <span class="help-block">Selectionnez le type de matériel</span>
                       	</div>
                    </div>
            	</div>
				<div class="card-footer">
					<button class="btn btn-sm btn-primary" type="submit">Créer</button>
					<button class="btn btn-sm btn-danger" type="reset">Reprendre</button>
				</div>
			</form>
		</div>
    </div>
  </div>
@endsection
