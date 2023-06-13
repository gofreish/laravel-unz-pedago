@extends('unz_st.acceuil.base')
@section('title')
    Voir le programme
@endsection
@section('content')

<style>
 .btn-purple {
    background-color: purple;
    color: white;
}

.btn-custom {
    background-color: purple;
    color: white; 
}

</style>


<div>
  <a href="{{route('programme.index')}}">
    <button class="btn btn-lg btn-dark btn-pill "> <i class=" cil-arrow-circle-left "></i></button>
  </a>
</div>
<!-- /.row-->
<div class="row">
  <div class="col-lg-12 text-center">
    @if(Session::has('message'))
      <div class="row">
        <div class="col-12">
          <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
        </div>
      </div>
    @endif
    <div class="display-4">
    	<span class="badge bg-secondary">UFR Sciences et Technologies </span>
    </div>

    <div class="card">
      <div class="card-header"><i class="fa fa-align-justify"></i> <span class="badge bg-secondary"><h5><strong>{{$programme->type_programme}}</strong></h5> </span> </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <tbody>
                    <tr>
                        <td>
                          <strong>Date de début</strong>
                        </td>
                        <td>
                          <span class="badge bg-secondary">
                            {{$programme->dateDebut}}
                          </span>
                        </td>
                    </tr>
              @if( !is_null($programme->dateFin) )
                    <tr>
                        <td>
                          <strong>Date de fin</strong>
                        </td>
                        <td>
                          <span class="badge bg-secondary">
                            {{$programme->dateFin}}
                          </span>
                        </td>
                    </tr>
              @endif
              @if( !is_null($programme->h_Deb_Matin) )
                    <tr>
                        <td>
                          <strong>Heure de début du matin</strong>
                        </td>
                        <td>
                          <span class="badge bg-secondary">
                            {{$programme->h_Deb_Matin}}
                          </span>
                        </td>
                    </tr>
              @endif
              @if( !is_null($programme->h_Fin_Matin) )
                    <tr>
                        <td>
                          <strong>Heure de fin du matin</strong>
                        </td>
                        <td>
                          <span class="badge bg-secondary">
                            {{$programme->h_Fin_Matin}}
                          </span>
                        </td>
                    </tr>
              @endif
              @if( !is_null($programme->h_Deb_Soir) )
                    <tr>
                        <td>
                          <strong>Heure de début du soir</strong>
                        </td>
                        <td>
                          <span class="badge bg-secondary">
                            {{$programme->h_Deb_Soir}}
                          </span>
                        </td>
                    </tr>
              @endif
              @if( !is_null($programme->h_Fin_Soir) )
                <tr>
                  <td>
                    <strong>Heure de fin du soir</strong>
                  </td>
                  <td>
                    <span class="badge bg-secondary">
                      {{$programme->h_Fin_Soir}}
                    </span>
                  </td>
              </tr>
            @endif
            <tr>
              <td>
                <strong>Filière</strong>
              </td>
              <td>
                <span class="badge bg-secondary">
                  {{$programme->filiere}}
                </span>
              </td>
            </tr>
            <tr>
             <td>
              <strong>Cycle</strong>
             </td>
              <td>
                <span class="badge bg-secondary">
                 {{$programme->cycle}}
                </span>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Semestre</strong>
              </td>
              <td>
                <span class="badge bg-secondary">
                  {{$programme->semestre}}
                </span>
              </td>
            </tr>
            <tr>
              <td>
                <strong>ECU</strong>
              </td>
              <td>
                <span class="badge bg-secondary">
                  {{$programme->nom_ecu}}
                </span>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Enseignant</strong>
              </td>
              <td>
                <span class="badge bg-secondary">
                  {{$enseignant->titre}} {{$enseignant->name}} {{$enseignant->prenom}}
                </span>
              </td>
            </tr>
            @if( !is_null($salle) )
              <tr>
                <td>
                  <strong>Salle</strong>
                </td>
                <td>
                  <span class="badge bg-secondary">
                    {{$salle->nom}}
                  </span>
                </td>
              </tr>
            @endif
            <tr>
              <td>
                <strong>Promotion</strong>
              </td>
              <td>
                <span class="badge bg-secondary">
                  {{$programme->promotion}}
                </span>
              </td>
            </tr>
            <tr>
              <td>
                  <strong>Coordonnateur</strong>
              </td>
              <td>
                <span class="badge bg-secondary">
                  {{$coordonnateur->titre}} {{$coordonnateur->name}} {{$coordonnateur->prenom}}
                </span>
              </td>
            </tr>
          </tbody>
      	</table>
      </div>
      @if($programme->user_id=== auth()->user()->id or auth()->user()->getRoleNames()->contains('scolarite'))
        <div class="card-footer">
            <div class="row justify-content-md-center">
              <div class="col-md-2">
                <a href="{{route('programme.edit', ['programme' => $programme->id])}}">
                    <button class="btn btn-block btn-info" type="button">
                        Modifier
                    </button>
                </a>
              </div>
            @if(!auth()->user()->getRoleNames()->contains('scolarite'))
              <div class="col-md-2">
                <form method="POST" action="{{route('programme.destroy', ['programme' => $programme->id])}}">
                  @csrf
                    <button class="btn btn-block btn-danger" onclick="return confirm('Ce programme sera supprimer');" type="submit" value="Delete">
                      Supprimer
                    </button>
                    <input type="hidden" name="_method" value="delete" />
                </form>
              </div>
            @endif

            @if(!$programme->public)
              <div class="col-md-2">
                <form method="POST" action="{{route('programme.publicUpdate', [$programme->id])}}">
                  @csrf
                    <button class="btn btn-block btn-success" onclick="return confirm('Ce programme sera publié');" type="submit" value="PUT">
                      Publier
                    </button>
                    <input type="hidden" name="marker" value="publier">
                    <input type="hidden" name="_method" value="put" />
                </form>
              </div>
            @endif
            @if(!auth()->user()->getRoleNames()->contains('scolarite'))
            <div class="col-md-2">
              <a href="{{route('programme.mail', [$programme->id])}}">
                <button class="btn btn-block btn-warning" onclick="return confirm('Le mail sera envoyé');" type="submit" value="PUT">
                  Envoyer un mail
                </button>
              </a>
            </div>
            <div class="col-md-2">
                <a href="{{ route('programme.sms', [$programme->id]) }}">
                    <button class="btn btn-block btn-custom" onclick="return confirm('Le message sera envoyé');" type="submit" value="PUT">
                       Envoyer un SMS
                   </button>
                </a>
            </div>

            <div class="col-md-2">
             <a href="{{ route('programme.telegramme', [$programme->id]) }}">
                <button class="btn btn-block btn-primary" onclick="return confirm('Le telegramme sera envoyé');" type="submit" value="PUT">
                   Envoyer telegramme
                </button>
            </a>
           </div>

            @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
           @endif
            @endif
          </div>
        </div>
      @endif
    </div>

  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection
