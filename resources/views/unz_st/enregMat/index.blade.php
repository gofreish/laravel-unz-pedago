@extends('unz_st.acceuil.base')
@section('title')
    Cahier de suivit
@endsection
@section('content')

<div class="row">
  <div>
      <x-Error/>
  </div>
  <div class="col text-center">
    @livewire('enreg-mat-index')
  </div>
</div>

@endsection
