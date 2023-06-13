<div class="row">
    {{-- The Master doesn't talk, he acts. --}}

    <div class="input-group">
        <span class="input-group-text">Filière</span>
        <select wire:model="selectedFiliere" name="filiere" id="filiere">
            <option value="" selected>Choisir la Filière</option>
            @foreach ($filieres as $filiere => $id)
                <option value="{{$id}}">{{ $filiere }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group">
        <span class="input-group-text">Promotion</span>
        <select name="promotion" id="promotion" required>
            <option selected></option>
            @foreach ($promotions as $promotion)
                <option value="{{$promotion->id}}">{{ $promotion->annee_entrer }}</option>
            @endforeach 
        </select>
    </div>
<!--
    <div class="col-md me-3 mt-2">
        <select wire:model="selectedFiliere" name="filiere" id="filiere">
            <option value="" selected>Choisir la Filière</option>
            @foreach ($filieres as $filiere => $id)
                <option value="{{$id}}">{{ $filiere }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md me-3 mt-2">
        <select name="promotion" id="promotion">
            <option value="" selected>Choisir la promotion</option>
            @foreach ($promotions as $promotion)
                <option value="{{$promotion->id}}">{{ $promotion->annee_entrer }}</option>
            @endforeach 
        </select>
    </div>
-->
</div>
