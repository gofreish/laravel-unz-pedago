<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('erreur'))
        <div class="alert alert-danger">
            {{ session('erreur') }}
        </div>
    @endif
    <div class="row badge bg-secondary fs-1 fw-bolder d-flex justify-content-center">
        Surveillants
    </div>
<!-- ################################# -->
    <div class="d-flex flex-row">
        <!-- Nouveau -->
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{route('surveillant.create')}}" class="btn btn-success">
                        <img src="{{asset('assets/icons/plus.svg')}}" alt="plus_icon">
                        Nouveau surveillant <i class="cib-addthis"></i>
                    </a>
                </li>
                <li class="list-group-item"><button wire:click="downloadListHead" class="btn btn-outline-primary">Télécharger le modèle de liste</button></li>
            </ul>
        </div>
        <!-- Upload -->
        <div class="card" >
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-secondary">Importer une liste de surveillant</li>
                <form action="{{route('surveillant.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <li class="list-group-item">
                        <input name="liste" type="file" class="form-control" id="inputGroupFile02" required>
                    </li>
                    <li class="list-group-item">
                        <button type="submit" class="btn btn-outline-success">Importer une liste de surveillant</button>
                    </li>
                </form>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="d-flex flex-row justify-content-center">
            <div class="form-check form-check-inline p-2 docs-highlight">
                <label class="form-check-label fw-bold" for="inlineRadio1">Filtrer par : </label>
            </div>
            <div class="form-check form-check-inline p-2 docs-highlight">
                <input wire:model="filtre" class="form-check-input" type="radio" name="filtre" id="filtre1" value="nom">
                <label class="form-check-label" for="inlineRadio1">Nom</label>
            </div>
            <div class="form-check form-check-inline p-2 docs-highlight">
                <input wire:model="filtre" class="form-check-input" type="radio" name="filtre" id="filtre2" value="non_paye">
                <label class="form-check-label" for="inlineRadio1">Surveillances non payés</label>
            </div>
            <div class="form-check form-check-inline p-2 docs-highlight">
                <input wire:model="filtre" class="form-check-input" type="radio" name="filtre" id="filtre3" value="total">
                <label class="form-check-label" for="inlineRadio1">Total de surveillances</label>
            </div>
            <div class="form-check form-check-inline p-2 docs-highlight">
                <input wire:model="ordre" class="form-check-input" type="radio" name="ordre" id="filtre4" value="asc">
                <label class="form-check-label" for="inlineRadio1">Ordre Croissant</label>
            </div>
            <div class="form-check form-check-inline p-2 docs-highlight">
                <input wire:model="ordre" class="form-check-input" type="radio" name="ordre" id="filtre5" value="desc">
                <label class="form-check-label" for="inlineRadio1">Ordre Décroissant</label>
            </div>
        </div>
        <div class="border mx-4 my-4">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col fw-bold fs-italic">CNIB</th>
                    <th scope="col fw-bold fs-italic">Genre</th>
                    <th scope="col fw-bold fs-italic">Nom</th>
                    <th scope="col fw-bold fs-italic">Prénom</th>
                    <th scope="col fw-bold fs-italic">Surveillance non payées</th>
                    <th scope="col fw-bold fs-italic">Surveillance  payées</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($surveillantListe as $surveillant)
                    <tr>
                        <th scope="row">{{ $surveillant->cnib }}</th>
                        <td>{{ $surveillant->genre }}</td>
                        <td>{{ $surveillant->nom }}</td>
                        <td>{{ $surveillant->prenom }}</td>
                        <td>{{ $surveillant->non_paye }}</td>
                        <td>{{ $surveillant->total }}</td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="4" scope="row">VIDE</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="">
                @for ($i = 1; $i <= $nbrPage; $i++)
                    @if ( $i == $page )
                        <div class="form-check form-check-inline p-2 docs-highlight">
                            <button wire:click="changePage({{$i}})" class="btn btn-primary">{{ $i }}</button>
                        </div>
                    @else
                        <div class="form-check form-check-inline p-2 docs-highlight">
                            <button wire:click="changePage({{$i}})" class="btn btn-outline-primary">{{ $i }}</button>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>
