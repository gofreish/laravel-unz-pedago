@extends('unz_st.acceuil.base')
@section('title')
    Toute les seances
@endsection
@section('content')
<!-- /.row-->
<div class="row">
  <div class="col-lg-12 text-center">
    @if(Session::has('message'))
      <div class="row">
        <div class="col-12">
          <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        </div>
      </div>
    @endif
    <h1 class=""><span class="badge bg-secondary">Liste de toutes les séances</span></h1>

    <!-- Tableau pour les séances -->
    <div class="card">
      <div class="card-body">
        @livewire('affichage-seance')
      </div>
    </div>

</div>
<!-- /.row-->
@endsection
