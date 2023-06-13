@extends('unz_st.acceuil.base')
@section('title')
    Relevés de notes
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center"> 
      @livewire('scolarite.releve-notes-index')
    </div>
  </div>
@endsection
