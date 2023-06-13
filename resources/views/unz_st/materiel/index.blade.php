@extends('unz_st.acceuil.base')
@section('title')
    Liste des matériel
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center">
      @livewire('materiel-index')
    </div>
  </div>
@endsection
