@extends('unz_st.acceuil.base')
@section('title')
    Tableau d'affichage
@endsection
@section('content')
  <div>
      <x-Error/>
  </div>
  <div class="col text-center">
    @livewire('programme-public')
  </div>
@endsection
