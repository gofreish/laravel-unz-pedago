@extends('unz_st.acceuil.base')
@section('title')
    Voir
@endsection
@section('content')
<?php
  use App\Models\Titre;
  $titreActuel = Titre::find($user->titre_id);
?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> Utilisateur {{ $user->name }}</div>
                    <div class="card-body">
                        <h4>Titre: {{ $titreActuel->titre }}</h4>
                        <h4>Nom: {{ $user->name }}</h4>
                        <h4>Prénom: {{ $user->prenom }}</h4>
                        <h4>Telephone: {{ $user->telephone }}</h4>
                        <h4>E-mail: {{ $user->email }}</h4>
                        <h4>R&ocircles : <?php
                          $roles = explode(",", $user->menuroles);
                        ?>
                          @foreach ($roles as $role)
                              <span class="badge bg-success">{{$role}}</span>
                          @endforeach
                        </h4>
                        <div class="card-footer">
                          @if( auth()->user()->id === $user->id)
                            <a href="{{ route('user.edit', ['user'=>$user->id]) }}" class="btn btn-block btn-success">{{ __('Editer') }}</a>
                          @endif
                            <a href="{{ url()->previous() }}" class="btn btn-block btn-primary">{{ __('Retour') }}</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
