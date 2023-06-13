@extends('unz_st.acceuil.base')
@section('title')
    Liste des surveillants
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center">
      @livewire('scolarite.surveillant-index')
    </div>
  </div>
@endsection
