@extends('unz_st.acceuil.base')
@section('title')
    Liste des evaluations
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center"> 
      @livewire('scolarite.evaluation-index')
    </div>
  </div>
@endsection
