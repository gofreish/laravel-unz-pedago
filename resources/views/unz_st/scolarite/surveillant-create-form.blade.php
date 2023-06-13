@extends('unz_st.acceuil.base')
@section('title')
    Nouveau Surveillant
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="col text-center">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('erreur'))
    <div class="alert alert-danger">
        {{ session('erreur') }}
    </div>
    @endif

    <div class="card mt-4 d-flex">
        <h5 class="card-header">Nouveau surveillant</h5>
        <div class="card-body">
            <form action="{{route('surveillant.store')}}" method="post">
                @csrf
                
                <!-- Genre -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Genre</span>
                    <input type="radio" class="btn-check" value="masculin" name="genre" id="masculin" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="masculin">Masculin</label>
                    <input type="radio" class="btn-check" value="feminin" name="genre" id="feminin" autocomplete="off">
                    <label class="btn btn-outline-primary" for="feminin">Féminin</label>
                </div>

                <!-- CNIB -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">CNIB</span>
                    <input value="{{old('cnib')}}" name="cnib" type="text" class="form-control" placeholder="numéro cnib" aria-label="cnib" aria-describedby="basic-addon1" required>
                </div>

                <!-- Nom -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nom</span>
                    <input name="nom" value="{{old('nom')}}" type="text" class="form-control" placeholder="nom" aria-label="nom" aria-describedby="basic-addon1" required>
                </div>

                <!-- Prénom -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Prénom</span>
                    <input name="prenom" value="{{old('prenom')}}" type="text" class="form-control" placeholder="prenom" aria-label="prenom" aria-describedby="basic-addon1" required>
                </div>

                <button type="submit" class="btn btn-outline-success">Ajouter le surveillant</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
