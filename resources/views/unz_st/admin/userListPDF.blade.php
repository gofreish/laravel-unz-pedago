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
              <h3><strong>Liste des {{ strtoupper($role) }}S </strong></h3>
            </caption>
          	<thead>
            	<tr>
            		<th>Nom</th>
            		<th>Prénom</th>
            		<th>Téléphone</th>
            		<th>Email</th>
            	</tr>
          </thead>
          <tbody>
            @forelse( $users as $user )
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->prenom}}</td>
                    <td>{{$user->telephone}}</td>
                    <td>{{$user->email}}</td>
                </tr>
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
