@extends('unz_st.acceuil.base')
@section('title')
    Modification de la seance
@endsection
@section('content')
<div>
            <a href="{{route('seance.show',[$seance->id])}}">
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
            <strong>Séance</strong>
          </div>
        </div>


        <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{route('seance.update', [$seance->id])}}">
        @csrf

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        ECU
                    </span>
                </div>
                <input class="form-control" id="fin-input" type="text" name="ecu" value=" {{$seance->nom_ecu}}" >

            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Date
                    </span>
                </div>
                <input class="form-control" id="fin-input" type="date" name="date" placeholder="date du cours" value="{{$seance->date}}">
            </div>
        </div>

          <!-- Heure de début-->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de début
                    </span>
                </div>
                <input class="form-control" id="heure-debut-input" type="time" name="heure_debut" placeholder="heure de début" value="{{$seance->hDebut}}">
            </div>
        </div>

                 <!-- Heure de fin-->
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Heure de fin
                    </span>
                </div>
                <input class="form-control" id="heure-fin-input" type="time" name="heure_fin" placeholder="heure de fin" value= "{{$seance->hFin}}" >

            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                      contenu
                    </span>
                </div>
                <textarea class="form-control" id="contenu" type="text" name="contenu" placeholder={{$seance->contenu}}>
                {{$seance->contenu}}
                </textarea>
        </div>
      </div>
    </div>

    <div class="card-footer">
          	<button class="btn btn-sm btn-primary" type="submit" value="PUT" onclick="return confirm('Cette seance sera modifiée ');"> Terminer</button>
              <input type="hidden" name="marker" value="modifier">
              <input type="hidden" name="_method" value="PUT" />
            <button class="btn btn-sm btn-danger" type="reset"> Recommencer</button>
        </div>
  </div>
</form>
@endsection
