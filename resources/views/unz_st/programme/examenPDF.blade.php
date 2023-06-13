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
              <h3><strong>Examen</strong></h3>
              <br> <br>
              <h5>
                Liste des examens a parti de <?php echo today(); ?>
              </h5>
            </caption>
          	<thead>
            	<tr>
            		<th>Date</th>
            		<th>Heure de début</th>
            		<th>Filiere</th>
            		<th>Cycle</th>
            		<th>Promotion</th>
            		<th>Semestre</th>
            		<th>Module</th>
            		<th>Enseignant</th>
            	</tr>
          </thead>
          <tbody>
            @forelse( $examens as $examen )
            <tr>
                <td>{{$examen['date']}}</td>
                <td>{{$examen['heureDebut']}}</td>
                <td>{{$examen['filiere']}}</td>
                <td>{{$examen['cycle']}}</td>
                <td>{{$examen['promotion']}}</td>
                <td>{{$examen['semestre']}}</td>
                <td>{{$examen['ecu']}}</td>
                <td>{{$examen['enseignant']}}</td>
            </tr>
            @empty
            <tr> Pas d'examen disponible </tr>
            @endforelse
          </tbody>
        </table>
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
