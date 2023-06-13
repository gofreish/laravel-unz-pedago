<!DOCTYPE html>

<html>

<head>

    <title>UFR-ST.com</title>

</head>

<body>
    <h4>Bonjour {{ $dataEnseignant['titreE'] }} {{ $dataEnseignant['prenom'] }} {{ $dataEnseignant['nomE'] }}</h4>
           <p>Vous êtes programmé pour le cours de <h4>{{ $dataEnseignant['ecu'] }}</h4> dans la filère {{ $dataEnseignant['filiere'] }}   
                 en {{ $dataEnseignant['cycle'] }} au titre du {{ $dataEnseignant['semestre'] }}.

               <h4>Date : <br>  {{\Carbon\Carbon::parse($dataEnseignant['dateDebut'])->format('l jS  F Y')}} au{{\Carbon\Carbon::parse($dataEnseignant['dateFin'])->format('l jS  F Y ')}}</h4>
           </p>

    <h4>Salle et horaires</h4>
    {{$dataEnseignant['salle'] }} <br>
        @if($dataEnseignant['h_Deb_Matin']!==null && $dataEnseignant['h_Deb_Soir'] !==null)
                <p>
                    {{ $dataEnseignant['h_Deb_Matin'] }} à {{ $dataEnseignant['h_Fin_Matin'] }} <br>
        
                   et de {{ $dataEnseignant['h_Deb_Soir'] }} à {{ $dataEnseignant['h_Fin_Soir'] }}
            </p>

        @elseif($dataEnseignant['h_Deb_Matin']!==null && $dataEnseignant['h_Deb_Soir'] ==null)
                <p>
                {{ $dataEnseignant['h_Deb_Matin'] }} à {{ $dataEnseignant['h_Fin_Matin'] }}
    
                </p>
           
          @elseif($dataEnseignant['h_Deb_Matin']==null && $dataEnseignant['h_Deb_Soir'] !==null)
                 <p>
                    {{ $dataEnseignant['h_Deb_Soir'] }} à {{ $dataEnseignant['h_Fin_Soir'] }}
                </p>
          @endif
          <p>
             <h4>Cordiallement {{ $dataEnseignant['titre'] }} {{ $dataEnseignant['prenom'] }} {{ $dataEnseignant['nom'] }} </h4> 
         </p>
   

    <p>L'UFR-ST vous remercie pour votre disponibilité</p>

</body>

</html>
