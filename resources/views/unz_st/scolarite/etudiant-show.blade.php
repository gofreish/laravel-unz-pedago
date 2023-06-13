@extends('unz_st.acceuil.base')
@section('title')
    Liste des Etudiants
@endsection
@section('content')

    <div class="row">
        <div>
            <x-Error/>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3 fs-2 fw-bold text-decoration-underline">Consultation et/ou modification des informations de l'étudiant</div>
    <div>
        <button class="btn btn-primary" id="btn_voir">Voir les informations</button>
        <button class="btn btn-warning" id="btn_editer">Editer les informations</button>
    </div>
    <div id="infos_block">
    <div class="d-flex flex-row">
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">INE : {{$etudiant->ine}}</li>
              <li class="list-group-item">Nom : {{$etudiant->nom}}</li>
              <li class="list-group-item">Prénom : {{$etudiant->prenom}}</li>
              <li class="list-group-item">Date de naissance : {{$etudiant->nee_le}}</li>
              <li class="list-group-item">Promotion : {{$promotion}}</li>
              <li class="list-group-item">Cycle : {{$cycle}}</li>
            </ul>
        </div>
        <!-- Licence -->
        <div class="card ms-3" style="width: 15rem;">
            <div class="card-body">
              <h5 class="card-title">Licence</h5>
              <ul class="list-group list-group-flush">
                @foreach ($historique['l'] as $id => $sem)
                <li class="list-group-item">
                    S{{$id}} : 
                    @if($sem['result'] == 'v')
                        <span class="text-success">Validé</span>
                    @endif
                    @if($sem['result'] == 'a')
                        <span class="text-danger">Ajourné {{$sem['times']}}</span> fois
                    @endif
                    @if($sem['result'] == 'n')
                        <span class="text-secondary">A venir</span>
                    @endif
                </li>
                @endforeach
              </ul>
            </div>
        </div>
        <!-- Master -->
        <div class="card ms-3" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title">Master</h5>
                <ul class="list-group list-group-flush">
                    @foreach ($historique['m'] as $id => $sem)
                        <li class="list-group-item">
                            S{{$id}} : 
                            @if($sem['result'] == 'v')
                                <span class="text-success">Validé</span>
                            @endif
                            @if($sem['result'] == 'a')
                                <span class="text-danger">Ajourné {{$sem['times']}}</span> fois
                            @endif
                            @if($sem['result'] == 'n')
                                <span class="text-secondary">A venir</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Doctorat -->
        <div class="card ms-3" style="width: 10rem;">
            <div class="card-body">
                <h5 class="card-title">Doctorat</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        @if($historique['d']['1']['result'] == 'f')
                                <span class="text-secondary">A venir</span>
                        @else
                            <span class="text-success">{{$historique['d']['1']['times']}} années écoulées</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
    <!-- ####################################################################################### -->
        <!-- EDIT -->
    <form id="edit-form" action="{{route('etudiant.update', ['etudiant'=>$etudiant->ine])}}" method="post">
        <div class="card">
            @csrf
            @method('PUT')
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">INE</span>
                        <input name="ine" type="text" class="form-control" value="{{$etudiant->ine}}">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Nom</span>
                        <input name="nom" type="text" value="{{$etudiant->nom}}" class="form-control" placeholder="">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Prénom</span>
                        <input name="prenom" type="text" value="{{$etudiant->prenom}}" class="form-control" placeholder="">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Date de naissance</span>
                        <input name="nee_le" type="date" value="{{$etudiant->nee_le}}" class="form-control" placeholder="">
                    </div>
                </li>
                 @livewire('select-filiere-promotion')
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-text">Cycle</span>
                        <select name="cycle" id="" required>
                            <option></option>
                            @forelse ($cycles as $item)
                                <option value="{{$item->id}}">{{ $item->cycle }}</option>
                            @empty
                                <option>Vide</option>
                            @endforelse
                        </select>
                    </div>
                </li>
            </ul>
        </div> 
        <!-- Parcours -->
        @livewire('scolarite.student-parcours')
        <button class="btn btn-success" type="submit">Valider</button>
    </form>
@endsection
@section('javascript')
<script>
    document.getElementById('btn_voir').style.display = "none";
    document.getElementById('edit-form').style.display = "none";

    document.getElementById('btn_voir').addEventListener('click', function(){
        this.style.display = "none";
        document.getElementById('edit-form').style.display = "none";
        document.getElementById('btn_editer').style.display = "block";
        document.getElementById('infos_block').style.display = "block";
    })
    document.getElementById('btn_editer').addEventListener('click', function(){
        this.style.display = "none";
        document.getElementById('infos_block').style.display = "none";
        document.getElementById('btn_voir').style.display = "block";
        document.getElementById('edit-form').style.display = "block";
    })
</script>
@endsection
