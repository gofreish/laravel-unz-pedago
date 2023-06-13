<!-- Liste des variables: $ecu ; $filieres ; $semestres ; $cycles; -->

@extends('unz_st.acceuil.base')
@section('title')
    Création d'ECU
@endsection
@section('content')

	<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
		  <x-Error/>
			<div class="card">
        <div class="card-header">
          <div class='text-center display-4'>
            <strong>ECU</strong>
          </div>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="{{route('ecu.store')}}" method="post" >
            @csrf
            <!-- Code -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="code">Code</label>
              <div class="col-md-6">
                <input class="form-control" id="code" type="text" name="code" placeholder="Code de l'ECU"><span class="help-block">Veuillez entrer le code de l'ECU</span>
              </div>
            </div>
            <!-- Nom -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="text-input">ECU</label>
              <div class="col-md-6">
                <input class="form-control" id="text-input" type="text" name="ecu" placeholder="Nom de l'ECU"><span class="help-block">Veuillez entrer le nom de l'ECU</span>
              </div>
            </div>
            <!-- Coefficient -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="coefficient">Coefficient</label>
              <div class="col-md-6">
                <input class="form-control" id="coefficient" type="text" name="coefficient" placeholder="coefficient de l'ECU"><span class="help-block">Veuillez entrer le coefficient de l'ECU</span>
              </div>
            </div>
            <!-- Choix de l UE -->
            @livewire('select-ue')
            <div class="card-footer">
              <button class="btn btn-sm btn-primary" type="submit"> Terminer</button>
              <button class="btn btn-sm btn-danger" type="reset"> Recommencer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
