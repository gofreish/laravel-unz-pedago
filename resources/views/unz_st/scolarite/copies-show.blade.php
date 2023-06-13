@extends('unz_st.acceuil.base')
@section('title')
    Liste des Etudiants
@endsection
@section('content')

  <div class="row">
    <div>
        <x-Error/>
    </div>

      @livewire('scolarite.copies-show', ['programme_id'=>$programme_id])
  </div>
@endsection
