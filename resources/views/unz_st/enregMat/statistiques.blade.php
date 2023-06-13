@extends('unz_st.acceuil.base')
@section('title')
    Statistiques
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center">
      @livewire('enreg-mat-statistiques')
    </div>
  </div>
@endsection
