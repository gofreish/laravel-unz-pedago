@extends('unz_st.acceuil.base')
@section('title')
    Liste des ECU
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center">
      @livewire('ecu-index')
    </div>
  </div>
@endsection
