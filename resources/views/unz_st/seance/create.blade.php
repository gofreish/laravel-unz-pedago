<!-- Variables envoyées:
  $date
  $heure_debut
  $heure_fin
  $contenu
  $user_id
  $ecu
-->

@extends('unz_st.acceuil.base')
@section('title')
    Création de séance
@endsection
@section('content')

  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center">
      <x-Error/>
      <div class="card">
        <div class="card-header">
          <div class='text-center display-4'>
            <strong>Séance</strong>
          </div>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="{{route('seance.store')}}" method="post" enctype="multipart/form-data">
            @csrf


             <!-- choix de l'ECU -->
             @livewire('select-e-c-u-seance')
            <!-- Date -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="date">Date</label>
              <div class="col-md-6">
                <input class="form-control" id="date" type="date" name="date" placeholder="date du cours"><span class="help-block">Entrez la date du cours</span>
              </div>
            </div>

            <!-- Heure de début -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="heure-debut">Heure de début</label>
              <div class="col-md-6">
                <input class="form-control" id="heure-debut" type="time" name="heure_debut" placeholder="heure de début du cours"><span class="help-block">Entrez l'heure de début du cours</span>
              </div>
            </div>
            <!-- Heure de fin -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="heure-fin">Heure de fin</label>
              <div class="col-md-6">
                <input class="form-control" id="heure-fin" type="time" name="heure_fin" placeholder="heure de fin du cours"><span class="help-block">Entrez l'heure de fin du cours</span>
              </div>
            </div>
            <!-- Contenu -->
            <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right" for="contenu">Contenu</label>
              <div class="col-md-6">
                <textarea class="form-control" id="contenu" type="time" name="contenu" placeholder="Contenu du cours">

                </textarea>
                <span class="help-block">Entrez ici les détails du cours</span>
              </div>
            </div>
            <hr>
            <!-- Si l utilisateur est authentifié -->
            @auth
              <input type="text" name="user_id" hidden value="1">
            @endauth
            <div class="card-footer">
              <button class="btn btn-sm btn-primary" type="submit"> Terminer</button>
              <button class="btn btn-sm btn-danger" type="reset"> Recommencer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
