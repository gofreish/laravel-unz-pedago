<!DOCTYPE html>

<html>

<head>

    <title>UFR-ST.com</title>

</head>

<body>
    <h4>Bonjour {{ $dataScolirite['titreS'] }} {{ $dataScolirite['prenomS'] }} {{ $dataScolirite['nomS'] }}</h4>
    <p>EXAMEN de </h4>{{ $dataScolirite['ecu'] }}</h4> 
               <h4>Date:  {{\Carbon\Carbon::parse($dataScolirite['date'])->format('l jS  F Y')}} </h4>
           </p>
           <p>
                <h4>Filère :  {{ $dataScolirite['filiere'] }} <br> promotion {{ $dataScolirite['promotion'] }}
                 <br>{{ $dataScolirite['cycle'] }} <br> {{ $dataScolirite['semestre'] }}
                </h4>
                Veuillez completer les horaires et salle.
            </p>
              
            <h4> Enseignant : {{$dataScolirite['titreE']}} {{ $dataScolirite['prenomE']}} {{$dataScolirite['nomE']}} {{$dataScolirite['tel']}}</h4>
            <p>
               <h4>Cordiallement {{ $dataScolirite['titre'] }} {{ $dataScolirite['prenom'] }} {{ $dataScolirite['nom'] }} </h4> 
            </p>
   

</body>

</html>