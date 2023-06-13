@extends('unz_st.acceuil.base')
@section('title')
    Tous les programmes
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
    @if(auth()->user()->getRoleNames()->contains('coordonateur'))
    <div class="display-4"><span class="badge bg-primary">Liste de mes programmes</span></div>
    <div class="col-2">
      <a href="{{route('programme.indexVoir')}}">
        <button class="btn btn-block btn-info" type="button">
          Tous les programmes
        </button>
      </a>
    </div>
    @endif
    <!-- Tableau 1 pour les cours -->
    <div class="card">
      <div class="card-header"><i class="fa fa-align-justify"></i> <span class="badge bg-primary"><h5><strong>Cours</strong></h5> </span> </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>ECU</th>
              <th>Filiere</th>
              <th>Cycle</th>
              <th>Semestre</th>
              <th>Promotion</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse( $cours as $cour )
              <tr>
                <td>
                  Du {{$cour->dateDebut}} au {{$cour->dateFin}}
                </td>
                <td>{{$cour->nom_ecu}}</td>
                <td>{{$cour->filiere}}</td>
                <td>{{$cour->cycle}}</td>
                <td>{{$cour->semestre}}</td>
                <td>{{$cour->promotion}}</td>
                @if($cour->public)
                <td><span class="badge bg-success">Publié</span></td>
                @else
                <td><span class="badge bg-danger">Non publié</span></td>
                @endif
                @if(!auth()->user()->getRoleNames()->contains('scolarite'))
                <td>
                  <a href="{{route('programme.show', ['programme'=>$cour->id])}}">
                    <button class="btn btn-block btn-info" type="button">
                      Voir
                    </button>
                  </a>
                </td>
                @endif
              </tr>
            @empty
            <tr> Pas de cours enregistré </tr>
            @endforelse
          </tbody>
        </table>
        <nav>
          {{$cours->links()}}
        </nav>
      </div>
    </div>

    <!-- Tableau 2 pour les EXAMEN -->
    <div class="card">
      <div class="card-header"><i class="fa fa-align-justify"></i>
        <span class="badge bg-secondary"><h5><strong>Examen</strong></h5></span>
        <a href="{{route('programme.examenPDF')}}"><button class="badge bg-success"><h5><strong>Telecharger</strong></h5></button></a>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>ECU</th>
              <th>Filiere</th>
              <th>Cycle</th>
              <th>Semestre</th>
              <th>Promotion</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse( $examens as $examen )
              <tr>
                <td>
                  {{$examen->dateDebut}}
                </td>
                <td>{{$examen->nom_ecu}}</td>
                <td>{{$examen->filiere}}</td>
                <td>{{$examen->cycle}}</td>
                <td>{{$examen->semestre}}</td>
                <td>{{$examen->promotion}}</td>
                @if($examen->public)
                <td><span class="badge bg-success">Publié</span></td>
                @else
                <td><span class="badge bg-danger">Non publié</span></td>
                @endif
                <td>
                  <a href="{{route('programme.show', ['programme'=>$examen->id])}}">
                    <button class="btn btn-block btn-info" type="button">
                      Voir
                    </button>
                  </a>
                </td>
              </tr>
            @empty
            <tr> Pas d'examen enregistré </tr>
            @endforelse
          </tbody>
        </table>
        <nav>
            {{$examens->links()}}
        </nav>
      </div>
    </div>

    <!-- Tableau 3 pour Autre -->
    <div class="card">
      <div class="card-header"><i class="fa fa-align-justify"></i> <span class="badge bg-secondary"><h5><strong>Autre</strong></h5> </span> </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>Heures</th>
              <th>Commentaire</th>
            </tr>
          </thead>
          <tbody>
            @forelse( $autres as $autre )
            <tr>
              <td>
                Du {{$autre->dateDebut}} au {{$autre->dateFin}}
              </td>
              <td>
                @if( !is_null($autre->h_Deb_Matin) )
                  De {{$autre->h_Deb_Matin}} à {{$autre->h_Fin_Matin}}
                @endif
                @if( !is_null($autre->h_Deb_Soir) )
                  De {{$autre->h_Deb_Soir}} à {{$autre->h_Fin_Soir}}
                @endif
              </td>
              <td>{{$autre->commentaire}}</td>
            </tr>
            @empty
            <tr> Aucun enregistrment pour ce type </tr>
            @endforelse
          </tbody>
        </table>
        <nav>
           {{$autres->links()}}
        </nav>
      </div>
    </div>

  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection
