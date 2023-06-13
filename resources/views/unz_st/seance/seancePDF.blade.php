<!DOCTYPE html>
<html lang="en">
  <head>
    <style type="text/css">
      table, td, th{
        border: 1px solid black;
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
      }
      .text_center{
        text-align: center;
        font-family:"times new roman", times, serif;
        font-style: italic;
      }
    </style>
  </head>

  <body class="c-app">
    <div class="text_center">
        <h3><strong>Cahier de texte de {{$donnees['ecu']}} de l'UE {{$donnees['ue']}}</strong></h3>
        <br> <br>
        <h4>Enseignant : {{$donnees['enseignantTitre']}} {{$donnees['enseignantPrenom']}} {{$donnees['enseignantName']}} </h4>
        <br> <br>
        <h5>
            {{$donnees['filiere']}} cycle {{$donnees['cyle']}} {{$donnees['semestre']}}
        </h5>
    </div>
    <div class="text_center"> <strong>
        {{$donnees['deleguePrenom']}} {{$donnees['delegueName']}}
    </strong></div>
    <table class="center">
        <tbody>
            @forelse( $donnees['seance'] as $cle => $seance )
                <tr width='10'>
                    <td> {{$seance['date']}}
                        @if( $seance['statut'] )
                            <strong style="font-style: italic;">Signé</strong>
                        @endif
                    </td>
                    <td rowspan=2> <textarea  cols="100" readonly>{{$seance['contenu']}}</textarea> </td>
                </tr>
                <tr>
                    <td>De {{$seance['hDebut']}} à {{$seance['hFin']}}</td>
                </tr>
            @empty
                <tr>
                    VIDE
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-body">

        <main class="c-main">
	<div class="row">
    <div class="col text-center">

    	<div class="card">
            <div class="card-body">
        	    <!-- Code pour l affichage -->

        	    <!-- Fin -->
            </div>
            <div class='card-footer'>
            </div>

        </div>

    </div>
    </div>

</main>
      </div>
    </div>
  </body>
</html>
