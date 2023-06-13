@extends('dashboard.base')
@section('title')
    Enregistrement Materiel
@endsection
@section('content')

	<div class="row">
		<div class="col-md-2"></div>
    <div class="col-md-8 text-center">
			<x-Error/>
      <div class="card">
        <div class="card-header">
          <div class='text-center display-4'>
            <strong>Registre du Matériel</strong>
          </div>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="{{route('enregmat.store')}}" method="post">
            @csrf
            <!-- Date -->
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="debut">Date</label>
              <div class="col-md-9">
                <input class="form-control" id="debut" type="date" name="date" placeholder="Entrez la date"><span class="help-block">Entrez la date</span>
              </div>
            </div>
            <!-- Quantité -->
            <div class="form-group row">
              <label class="col-md-3 col-form-label" for="quantite">Quantité</label>
              <div class="col-md-9">
                <input class="form-control" id="quantite" type="number" name="quantite" placeholder="Quantité du Matériel"><span class="help-block">Entrez la Quantité du Matériel</span>
              </div>
            </div>
            <!-- Type d'enregistrement matériel -->
            @livewire('select-typeenreg')

            <!-- Matériel -->
            @livewire('select-materiel')

            <!-- Personne -->
            @livewire('select-user')
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
