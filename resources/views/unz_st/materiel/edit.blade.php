@extends('unz_st.acceuil.base')
@section('title')
    Edition de materiel
@endsection
@section('content')
<?php
use App\Models\TypeMateriel;
	$types = TypeMateriel::all();
    $selectedType = TypeMateriel::find($materiel->type_materiel_id);
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
        	<form class="form-horizontal" action="{{route('materiel.update', [$materiel->id])}}" method="POST">
        		@csrf
                @method('PUT')
        		<div class="card-header"><strong>Mis à jour</strong> de matériel</div>
            	<div class="card-body">
					<!-- Le nom -->
					<div class="form-group row">
						<label class="col-md-3 col-form-label" for="nom">Nom</label>
                    	<div class="col-md-9">
                        <input class="form-control" id="nom" type="text" name="name" value="{{$materiel->name}}" required ><span class="help-block">Mettez ici le nom du matériel</span>
                        </div>
                    </div>
                    <!-- La quantité -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="quantite">Quantité</label>
                        <div class="col-md-9">
                        <input class="form-control" id="quantite" type="number" name="quantite" value="{{$materiel->quantite}}" required><span class="help-block">La quantité initiale du matériel</span>
                        </div>
                    </div>
                    <!-- Type du matériel -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="type">Type</label>
                        <div class="col-md-9">
                        <select class="form-control" id="type" name="type_materiel_id" required>
                        	<option value="{{$selectedType->id}}" selected>{{$selectedType->type}}</option>
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
					<button class="btn btn-sm btn-primary" type="submit">Modifier</button>
					<button class="btn btn-sm btn-danger" type="reset">Reprendre</button>
				</div>
			</form>
		</div>
    </div>
  </div>
@endsection
