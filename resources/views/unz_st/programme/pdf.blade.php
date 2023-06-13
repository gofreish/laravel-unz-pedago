<!DOCTYPE html>
<html lang="en">
  <head>
    <style type="text/css">
      table{
        border-collapse: collapse;
      }
      td, th{
        border: 1px solid black;
      }
    </style>
  </head>

  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
      <div class="c-body">

        <main class="c-main">
	<div class="row">
    <div class="col text-center">

    	<div class="card">
        <div class="card-body">
        	<!-- Code pour l affichage -->
        	<table class="table table-responsive-sm table-bordered table-striped table-sm">
            <caption>
              <h3><strong>Programme</strong></h3>
              <br> <br>
              <h5>
                UFR Sciences et technologies <br>
                {{$filiereName}} promotion {{$promotion}} <br>
                Emploi du temps <br>
              </h5>
            </caption>
          	<thead>
            	<tr>
            		<th>Semaine</th>
            		<th>lundi</th>
            		<th>mardi</th>
            		<th>mercredi</th>
            		<th>jeudi</th>
            		<th>vendredi</th>
            		<th>samedi</th>
            	</tr>
          </thead>
          <tbody>
            @forelse( $superProgrammeTab as $lundi => $programme )
            <tr>
            <td>
              Du {{\Carbon\Carbon::parse( $lundi )->format('d-m-Y')}} au {{ \Carbon\Carbon::parse( $lundi )->endOfWeek()->format('d-m-Y') }}
            </td>
            @foreach( $programme as $jour => $contenu )
            <td>
             <?php
             echo html_entity_decode($contenu)?>
            </td>
            @endforeach
              </tr>
            @empty
            <tr> Pas de programme disponible </tr>
            @endforelse
          </tbody>
        </table>
        	<!-- Fin -->
        </div>
        <div class='card-footer'>
        	<strong>NB : </strong>Ce programme est susceptible d'être modifié. Veuillez consulter régulièreme le programme.<br>
        	<blockquote class="blockquote text-right">
        	<strong class='text-right'>{{$coordonateur['titre']}} {{$coordonateur['prenom']}} {{$coordonateur['nom']}}</strong>
        	</blockquote>
        </div>

     </div>

    </div>
  </div>

</main>
      </div>
    </div>
  </body>
</html>
