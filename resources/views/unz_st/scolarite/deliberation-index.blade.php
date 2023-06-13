@extends('unz_st.acceuil.base')
@section('title')
    Déliberations
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center"> 
      @livewire('scolarite.deliberation-index')
    </div>
  </div>
@endsection
