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
              <h3><strong>{{$SemestreName}} {{$FiliereName}}</strong></h3>
              <br> <br>
              <h5>
                Liste des UE avec leur ECU
              </h5>
            </caption>
          	<thead>
            	<tr>
            		<th>UE</th>
                    <th>Crédits</th>
                    <th>VH</th>
                    <th>Code EC</th>
                    <th>EC</th>
                    <th>Coefficient</th>
                    <th>VHF</th>
                    <th>VHA</th>
            	</tr>
          </thead>
          <tbody>
            @forelse( $tableau as $cle => $ue )
              	@foreach($ue['ec'] as $key => $ecu)
              	<tr>
              		<td>{{$ue['nom']}}</td>
              		<td>{{$ue['credit']}}</td>
              		<td>{{$ue['VH']}}</td>
              		<td>{{$ecu['code']}}</td>
              		<td>{{$ecu['nom']}}</td>
              		<td>{{$ecu['coefficient']}}</td>
              		<td>{{$ecu['VHF']}}</td>
              		<td>{{$ecu['VHA']}}</td>
              	</tr>
              	@endforeach
              @empty
              <tr> VIDE </tr>
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
