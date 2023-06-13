<!-- J arrange le cas de ECU avant de continuer avec les autres elements du  bread -->

<!--
    
    1 =>    |Nom => val
            |credit => Val
            |VH => val
            |EC =>  |CodeUE =>val
                    |Nom => val
                    |Poids =>val
                    |VHF => val
                    |VHA => val

-->

	-------- Ajout ------------
22/09/2021
Améliorarion de l en tête 

	-------- Fonctions utilie -------------
$user->assignRole('admin');
User::find(3)->getRoleNames()

//Envoi de formulaire avec le méthode DELETE
@csrf
@method('DELETE')

//Creation de messages flash
$request->session()->flash('message', 'ICI le message');

//Affichage de messages flash
@if(Session::has('message'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        </div>
                    </div>
                @endif 

<!------- Ouverture d une fenetre modale -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Bouton d activation
</button>
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Titre du modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                Contenu du Modal                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Proverbe Livewire -->
"Parce qu'elle ne rivalise avec personne, personne ne peut rivaliser avec elle.",
     « Le meilleur athlète veut que son adversaire soit à son meilleur. »
     'Rien au monde n'est aussi doux et souple que l'eau.',
     'Être comme l'eau.',
     'Au travail, faites ce que vous aimez.',
     « Faites attention à l'approbation des gens et vous serez leur prisonnier. »
     'Fais ton travail, puis recule.',
     "Le succès est aussi dangereux que l'échec.",
     'Le Maître ne parle pas, il agit.',
     "Un bon voyageur n'a pas de plans fixes et n'a pas l'intention d'arriver.",
     « Connaître les autres, c'est l'intelligence ; se connaître est la vraie sagesse.',
     'Si votre bonheur dépend de l'argent, vous ne serez jamais content de vous-même.',
     « Si vous vous tournez vers les autres pour vous épanouir, vous ne serez jamais vraiment épanoui. »
     « Pour atteindre la connaissance, ajoutez des choses chaque jour ; Pour atteindre la sagesse, soustrayez des choses chaque jour.',
     'Ferme tes yeux. Comptez jusqu'à un. C'est ce que l'on ressent pour toujours.',
     'Le monde entier t'appartient.',
     'Arrêtez d'essayer de contrôler.',