@extends('dashboard.authBase')

@section('content')
<?php 
    use App\Models\Titre;
    $titres = Titre::all();
?>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <h1>{{ __('Enregistrement') }}</h1>
                    <p class="text-muted">Créer un compte</p>
                    <!-- Le nom -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-user"></i>
                        </span>
                        </div>
                        <input class="form-control" type="text" placeholder="{{ __('Nom') }}" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <!-- Le prénom -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-user"></i>
                        </span>
                        </div>
                        <input class="form-control" type="text" placeholder="{{ __('Prenom') }}" name="prenom" value="{{ old('prenom') }}" required>
                    </div>
                    <!-- Le titre -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="cil-school"></i>
                        </span>
                        </div>
                        <select class="form-control" id="titre" name="titre" required>
                            <option selected>Choisir un titre</option>
                            @foreach($titres as $titre)
                                <option value="{{$titre->id}}">
                                    {{$titre->titre}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Telephone -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="cil-address-book"></i>
                        </span>
                        </div>
                        <input class="form-control" type="tel" placeholder="{{ __('contact') }}" name="telephone" value="{{ old('telephone') }}" required>
                    </div>
                    <!-- Adresse mail -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required>
                    </div>
                    <!--Mot de passe -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-lock"></i>
                        </span>
                        </div>
                        <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                    </div>
                    <!-- Confirmation du mot de passe -->
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-lock"></i>
                        </span>
                        </div>
                        <input class="form-control" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>
                </form>
            </div>
            <div class="card-footer p-4">
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-block btn-facebook" type="button">
                    <span>facebook</span>
                  </button>
                </div>
                <div class="col-6">
                  <button class="btn btn-block btn-twitter" type="button">
                    <span>twitter</span>
                  </button>
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