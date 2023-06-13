<div>
    <style>
        
    </style>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="display-4 text-secondary text-decoration-underline">
        Relevés de notes
    </div>
    <h4 class="d-flex justify-content-center mt-3">
        Filtrez ce que vous voulez voir
    </h4>
    <div class="row mt-3 border fw-bold">
        <div class="col">
            <label>Copies récupérées</label>
            <div>
                <label>Oui</label>
                <input wire:model="areRecup" value="true" type="radio" name="areRecup">
                <label>Non</label>
                <input wire:model="areRecup" value="false" type="radio" name="areRecup">
            </div>
        </div>
        <div class="col">
            <label>Copies retournées</label>
            <div>
                <label>Oui</label>
                <input wire:model="areReturn" value="true" type="radio" name="areReturn">
                <label>Non</label>
                <input wire:model="areReturn" value="false" type="radio" name="areReturn">
            </div>
        </div>
        <div class="col">
            <label>Relevés envoyés</label>
            <div>
                <label>Oui</label>
                <input wire:model="hasNote" value="true" type="checkbox" name="releve_upload">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        <button wire:click="showNotes" class="btn btn-primary">Voir</button>
    </div>
    <div>
        @if ( !is_null($uploadSuccessMsg) ) <h5 class="text-success">{{ $uploadSuccessMsg }}</h5> @endif
        @if ( !is_null($uploadErrorMsg) ) <h5 class="text-danger">{{ $uploadErrorMsg }}</h5> @endif
    </div>

    <div class="mt-3">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col fw-bold fs-italic">Module</th>
                    <th scope="col fw-bold fs-italic">Session</th>
                    <th scope="col fw-bold fs-italic">Nombre de copies</th>
                    <th scope="col fw-bold fs-italic">Date de sortie</th>
                    <th scope="col fw-bold fs-italic">Date de retour</th>
                    <th scope="col fw-bold fs-italic">Relevés</th>
                    <th scope="col fw-bold fs-italic"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($copies as $cle => $copie)
                    <tr>
                        <td rowspan="2">{{ $copie['nomECU'] }}</td>
                        <td>
                            @if ( $copie['is_normal'] )
                                Session Normale
                            @else
                                Session de rattrapage
                            @endif
                        </td>
                        <td>{{ $copie['nbr_copie'] }}</td>
                        <td>{{ $copie['date_sortie'] }}</td>
                        <td>{{ $copie['date_retour'] }}</td>
                        @if ( $copie['has_note'] )
                            <td><span class="badge bg-success">Déja envoyé</span></td>
                            <td><button wire:click="downloadOldReleve({{$copie['copie_id']}})" class="btn btn-primary">Télécharger l'ancien relevé</button></td>
                        @else
                            <td><span class="badge bg-danger">Non envoyé</span></td>    
                            <td><button wire:click="downloadReleve({{$copie['copie_id']}})" class="btn btn-primary">Télécharger la liste</button></td>
                        @endif
                        
                    </tr>
                    <tr>
                    @if ( !is_null($copie['date_sortie']) )
                        <td colspan="5">
                            <form wire:submit.prevent="uploadNotes({{$copie['copie_id']}})">
                                <div class="input-group mb-3">
                                    <input wire:model="notes" name="notes" type="file" class="form-control" required>
                                    <button class="btn btn-outline-success" type="submit">Envoyer le relevé de note</button>
                                  </div>
                            </form>
                        </td>
                    @endif
                    </tr>
                @empty
                    <tr>
                        <th colspan="6" scope="row">Aucun resultat</th>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 mx-5 border">
        <span class="fs-4">Veuillez prêter attention aux éléments suivants : </span>
        <ul>
            <li>
                <h4 class="fs-5 badge text-warning">Les relevés doivent être d'extension xlsx</h4>
            </li>
            <li>
                <h4 class="fs-5 badge text-danger">Utilisé que des chiffres dans la colonne note. Sinon le système le considère comme 0/20</h4>
            </li>
        </ul>
    </div>

</div>
