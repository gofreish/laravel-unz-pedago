<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('erreur'))
    <div class="alert alert-danger">
        {{ session('erreur') }}
    </div>
    @endif

    <div class="card mt-4 d-flex">
        <h5 class="card-header">Nouveau étudiant</h5>
        <div class="card-body">
            <form action="{{route('etudiant.store')}}" method="post">
                @csrf
                
                <!-- Genre -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Genre</span>
                    <input wire:model="genre" type="radio" class="btn-check" value="masculin" name="genre" id="masculin" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="masculin">Masculin</label>
                    <input wire:model="genre" type="radio" class="btn-check" value="feminin" name="genre" id="feminin" autocomplete="off">
                    <label class="btn btn-outline-primary" for="feminin">Féminin</label>
                </div>

                <!-- INE -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">INE</span>
                    <input wire:model="ine" value="{{old('ine')}}" name="ine" type="text" class="form-control" placeholder="ine" aria-label="ine" aria-describedby="basic-addon1" required>
                </div>

                <!-- Nom -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nom</span>
                    <input name="nom" value="{{old('nom')}}" type="text" class="form-control" placeholder="nom" aria-label="nom" aria-describedby="basic-addon1" required>
                </div>

                <!-- Prénom -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Prénom</span>
                    <input name="prenom" value="{{old('prenom')}}" type="text" class="form-control" placeholder="prenom" aria-label="prenom" aria-describedby="basic-addon1" required>
                </div>
                
                <!-- Date de naissance -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Date de naissance</span>
                    <input name="date_naissance" value="{{old('date_naissance')}}" type="date" class="form-control" aria-label="date de naissance" aria-describedby="basic-addon1" required>
                </div>
                
                <!-- Filiere -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Filière</span>
                    <select class="form-control" wire:model="selectedFiliere" name="filiere" id="filiere">
                        <option value="null" selected>Choisir la Filière</option>
                        @foreach ($filieres as $filiere => $id)
                            <option value="{{$id}}">{{ $filiere }}</option>
                        @endforeach
                    </select>
                </div>

                <!--Promotion-->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Promotion</span>
                    <select class="form-control" name="promotion" id="promotion" required>
                        <option value="null" selected>Choisir la promotion</option>
                        @foreach ($promotions as $promotion)
                            <option value="{{$promotion->id}}">{{ $promotion->annee_entrer }}</option>
                        @endforeach 
                    </select>
                </div>
                
                <!--Cycle-->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Cycle</span>
                    <select class="form-control" name="cycle" id="cycle" required>
                        <option value="null" selected>Choisir le cycle</option>
                        @foreach ($cycles as $cycle)
                            <option value="{{$cycle->id}}">{{ $cycle->cycle }}</option>
                        @endforeach 
                    </select>
                </div>

                @livewire('scolarite.student-parcours')

                <button type="submit" class="btn btn-outline-success">Ajouter l'étudiant</button>
            </form>
        </div>
      </div>
</div>
