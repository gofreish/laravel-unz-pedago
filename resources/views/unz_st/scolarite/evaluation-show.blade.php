@extends('unz_st.acceuil.base')
@section('title')
    Liste des Etudiants
@endsection
@section('content')

  <div class="row">
    <div>
        <x-Error/>
    </div>
    <div class="row d-flex justify-content-center">
      <div>
        <span class="display-4 fw-bold">Programmation de l'évaluation</span>
      </div>
      <div class="card m-4" style="width: 30rem;">
          <div class="card-body">
              <h5 class="card-title">{{ $evaluation->nomECU }}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Date : {{ $evaluation->date }}</h6>
              <h6 class="card-subtitle mb-2 text-muted">De : {{ $evaluation->heureDebut }} à {{ $evaluation->heureFin }}</h6>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Promotion : {{ $evaluation->promotion }}</li>
                <li class="list-group-item">Enseignant : {{ $evaluation->prenomEnseignant }} {{ $evaluation->nomEnseignant }}</li>
                <li class="list-group-item">
                  @if ( $evaluation->isPublier )
                    <span class="badge bg-success">Déjà publié</span>
                  @else
                    <span class="badge bg-danger">Non publié</span>    
                  @endif
                </li>
              </ul>
          </div>
      </div>
    </div>

    @livewire('scolarite.evaluation-show', ['id'=>$evaluation->id])
    </div>
@endsection
