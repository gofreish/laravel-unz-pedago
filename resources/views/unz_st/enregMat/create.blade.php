@extends('unz_st.acceuil.base')
@section('title')
    Nouveau enregistrement
@endsection
@section('content')
<div>
          <a href="{{route('enregMat.index')}}">
            <button class="btn btn-lg btn-dark btn-pill "> <i class=" cil-arrow-circle-left "></i></button>
          </a>
     </div>
    <div class="row">
        <div class="col-md-2"></div>
    <div class="col-md-8 text-center">
            <x-Error/>
      <div class="card">
        <div class="card-header">
          <div class='text-center display-4'>
            @if(Session::has('message'))
              <div class="row">
                  <div class="col-12">
                      <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
                  </div>
              </div>
            @endif
            <strong>Nouveau enregistrement</strong>
          </div>
        </div>
        <div class="card-body">
          @livewire('enreg-mat-create')
        </div>
      </div>
    </div>
  </div>
@endsection
