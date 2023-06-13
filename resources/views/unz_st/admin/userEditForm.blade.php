<!-- Prochain Travail
  Etablir un systeme permettant d ajouter des roles a un user -->
@extends('unz_st.acceuil.base')
@section('title')
    Modifier
@endsection
@section('content')
<?php
  use App\Models\Titre;
  use Illuminate\Support\Facades\DB;
  $titreActuel = Titre::find($user->titre_id);
  $titres = Titre::all();
  $allRoles = DB::table('roles')->pluck('name');
  $userRolesArray = explode(",", $user->menuroles);
?>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Modifier') }} {{ $user->name }}</div>
                    <div class="card-body">
                        <br>
                        <form  method="POST" action="{{route('user.update', ['user' => $user->id])}}">
                            @csrf
                            @method('PUT')
                            <!-- Le nom -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <svg class="icon icon-sm">
                                          <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                      </svg>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                            @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- prenom -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <svg class="icon icon-sm">
                                          <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                      </svg>
                                    </span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('Prenom') }}" name="prenom" value="{{ $user->prenom }}" required>
                            </div>
                            @error('prenom')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
                                <input class="form-control" type="text" placeholder="{{ __('Telephone') }}" name="telephone" value="{{ $user->telephone }}" required>
                            </div>
                            <!-- Adresse Mail -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ $user->email }}" required>
                            </div>
                            @error('email')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!--Roles-->
                            <div class="d-flex mb-2">
                              @foreach ($allRoles as $role)
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="checkbox" name="{{$role}}" @if (in_array($role, $userRolesArray)) checked @endif>
                                  <label class="form-check-label" for="inlineCheckbox1">{{$role}}</label>
                                </div>
                              @endforeach
                            </div>

                            <!-- Affiche ou cache le MDP -->
                            <div class="mb-3 d-flex justify-content-center">
                              <div class="form-check">
                                <input type="checkbox" name="changer" class="form-check-input" id="showPassword" onclick="newPass()">
                                <label class="form-check-label" for="exampleCheck1">Changer le mot de passe</label>
                              </div>
                            </div>

                            <!-- password -->
                            @if($user->id===auth()->user()->id)
                            <div id="pass">
                              <!-- Ancien mot de passe -->
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Ancien mot de passe</span>
                                <input id="ancien" name="ancien_password" type="password" class="form-control">
                                <div class="input-group-text">
                                  <input onclick="show('ancien')" class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for password input">
                                  afficher
                                </div>
                              </div>
                              @error('ancien_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                              @enderror

                              <!-- Nouveau mot de passe -->
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nouveau mot de passe</span>
                                <input id="nouveau" name="nouveau_password" type="password" class="form-control">
                                <div class="input-group-text">
                                  <input onclick="show('nouveau')" class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for password input">
                                  afficher
                                </div>
                              </div>
                              @error('nouveau_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                              
                              <!-- Confirmer le nouveau mot de passe -->
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nouveau mot de passe</span>
                                <input id="confirm" name="confirm_password" type="password" class="form-control">
                                <div class="input-group-text">
                                  <input onclick="show('confirm')" class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for password input">
                                  afficher
                                </div>
                              </div>
                            </div>
                              @error('confirm_password')
                                <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            @endif
                            <?php if (auth()->user()->getRoleNames()->contains('admin')): ?>
                              <button class="btn btn-block btn-success" type="submit">{{ __('Enregister') }}</button>
                            <?php endif ?>
                            <a href="{{ url()->previous() }}" class="btn btn-block btn-primary">{{ __('Retour') }}</a>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')
  <script>
    document.getElementById("pass").style.display = "none";

    function show( identifiant ) {
      var x = document.getElementById(identifiant);
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }

    function newPass(){
      let passDiv = document.getElementById("pass");
      if( document.getElementById("showPassword").checked ){
        passDiv.style.display = "block";
      }else{
        passDiv.style.display = "none";
      }
    }
  </script>
@endsection
