@extends('unz_st.acceuil.base')
@section('title')
    Reception des copies
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center"> 
      @livewire('scolarite.suivit-copie-index')
    </div>
  </div>
@endsection
