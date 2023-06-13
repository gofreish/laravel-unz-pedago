@extends('unz_st.acceuil.base')
@section('title')
    Statistiques
@endsection
@section('content')
  <div class="row">
    <div class="col text-center">

    <div class="card">
        <div class="card-header">
            <div class='text-center display-4'>
              <strong>Statistiques du {{$typeMat_name}} {{$materiel_name}}</strong>
            </div>
        </div>
        <div class="card-body">
          <!-- Code pour l affichage -->
          <div class="card">
            <div class="card-header">Statistiques</div>
            <div class="card-body">
              <div class="c-chart-wrapper" >
                <canvas class="chart" id="statistique" ></canvas>
              </div>
            </div>
          </div>
          <!-- Fin -->
        </div>
     </div>

     <div class="card">
      <div class="card-header">
        <div>
          <span class="badge bg-secondary">
          <h1>
          @if( !is_null($debut) )
            @if( !is_null($fin) )
              Enregistrement du {{$debut}} au {{$fin}}
            @else
              Enregistrement à partir du {{$debut}}
            @endif
          @else
            @if( !is_null($fin) )
              Enregistrement jusqu'au {{$fin}}
            @else
              Tous les enregistrements
            @endif
          @endif
          </h1>
          </span>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>Action</th>
              <th>Matériel</th>
              <th>Quantité</th>
              <th>Auteur</th>
              <th>Statut</th>
            </tr>
          </thead>
          <tbody>
            @forelse( $enregistrements as $enregistrment )
              <tr>
                <td>{{$enregistrment->date}}</td>
                <td>
                  @if( $enregistrment->typeEnregId == 1 )
                    <span class="badge badge-pill bg-success">
                      {{$enregistrment->type}}
                    </span>
                  @elseif( $enregistrment->typeEnregId == 2 )
                    <span class="badge badge-pill bg-warning">
                      {{$enregistrment->type}}
                    </span>
                  @else
                    <span class="badge badge-pill bg-secondary">
                      {{$enregistrment->type}}
                    </span>
                  @endif
                </td>
                <td>{{$enregistrment->materiel}}</td>
                <td>{{$enregistrment->quantite}}</td>
                <td>{{$enregistrment->titre}} {{$enregistrment->name}} {{$enregistrment->prenom}}</td>
                <th>
                  @if( $enregistrment->achever )
                    <span class="badge badge-pill bg-success">Achevé</span>
                  @else
                    <span class="badge badge-pill bg-warning">En cours</span>
                  @endif
                </th>
            @empty
            <tr> LE CAHIER EST VIDE </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    </div>
  </div>
@endsection

@section('javascript')
	<script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
  <script>

    const data = JSON.parse('<?php echo $data; ?>');

		// eslint-disable-next-line no-unused-vars ['January', 'February', 'March']
    const lineCharts = new Chart(document.getElementById('statistique'), {
      type: 'line',
      data: {
        labels : data[0],
        datasets : [
          {
            label: 'Entré',
            backgroundColor : 'rgba(99, 111, 131, 0.2)',
            borderColor : 'rgba(99, 111, 131, 1)',
            pointBackgroundColor : 'rgba(99, 111, 131, 1)',
            pointBorderColor : '#fff',
            data : data[1]
          },
          {
            label: 'Sortie',
            backgroundColor : 'rgba(151, 187, 205, 0.2)',
            borderColor : 'rgba(151, 187, 205, 1)',
            pointBackgroundColor : 'rgba(151, 187, 205, 1)',
            pointBorderColor : '#fff',
            data : data[2]
          },
          {
            label: 'Retour',
            backgroundColor : 'rgba(249, 177, 21, 0.2)',
            borderColor : 'rgba(249, 177, 21, 1)',
            pointBackgroundColor : 'rgba(249, 177, 21, 1)',
            pointBorderColor : '#fff',
            data : data[3]
          }
        ]
      },
      options: {
        responsive: true,
        aspectRatio: 3
      }
    })
  </script>
@endsection
