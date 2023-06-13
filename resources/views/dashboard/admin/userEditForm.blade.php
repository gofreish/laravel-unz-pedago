<!-- Prochain Travail
  Etablir un systeme permettant d ajouter des roles a un user -->
@extends('dashboard.base')

@section('content')
<?php 
  use App\Models\Titre;
  $titreActuel = Titre::find($user->titre_id);
  $titres = Titre::all();
?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Edit') }} {{ $user->name }}</div>
                    <div class="card-body">
                        <br>
                        <form method="POST" action="{{route('user.update', ['user' => $user->id])}}">
                            @csrf
                            @method('PUT')
                            <!-- Le nom -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <svg class="c-icon c-icon-sm">
                                          <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                      </svg>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                            <!-- prenom -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <svg class="c-icon c-icon-sm">
                                          <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                      </svg>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Prenom') }}" name="prenom" value="{{ $user->prenom }}" required>
                            </div>
                            <!-- Titre -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="cil-school"></i>
                                    </span>
                                </div>
                                  <select class="form-control" id="titre" name="titre" required>
                                    <option value="{{$titreActuel->id}}" selected>{{$titreActuel->titre}}</option>
                                    @foreach($titres as $titre)
                                      <option value="{{$titre->id}}">
                                      {{$titre->titre}}
                                      </option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <!-- Telephone -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="cil-address-book"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Prenom') }}" name="telephone" value="{{ $user->telephone }}" required>
                            </div>
                            <!-- Adresse Mail -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ $user->email }}" required>
                            </div>
                            <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="{{ route('users.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a> 
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection