<?php use Illuminate\Support\Facades\Auth; ?>
<!DOCTYPE html>

<html>

<head>

    <title>UFR-ST.com</title>

</head>

<body>
    <h4>Bonjour {{$dataScolirite['titreE']}} {{ $dataScolirite['prenomE']}} {{$dataScolirite['nomE']}}</h4>
           <p>EXAMEN de </h4>{{ $dataScolirite['ecu'] }}</h4> 
               <h4>Date:  {{\Carbon\Carbon::parse($dataScolirite['date'])->format('l jS F Y')}} </h4>
           </p>
           <p>
                <h4>Filère :  {{ $dataScolirite['filiere'] }} <br> promotion {{ $dataScolirite['promotion'] }}
                 <br>{{ $dataScolirite['cycle'] }} <br> {{ $dataScolirite['semestre'] }}
                </h4>

            </p>

            <p>
               <h4>Cordiallement {{ $dataScolirite['titre'] }} {{ $dataScolirite['prenom'] }} {{ $dataScolirite['nom'] }} <span class="text text-primary"><?php echo Auth::email(); ?></span> </h4> 
            </p>
   

</body>

</html>