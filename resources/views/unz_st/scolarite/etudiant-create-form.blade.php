@extends('unz_st.acceuil.base')
@section('title')
    Liste des Etudiants
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center">
        @livewire('scolarite.etudiant-create-form')
    </div>
  </div>
@endsection
