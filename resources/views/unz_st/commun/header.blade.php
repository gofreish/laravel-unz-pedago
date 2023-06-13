  <?php use App\Models\Titre;?>

<header class="header">
  <div class="col">
  <a class="header-brand" href="#">
    <img class="sidebar-brand-full" src="{{ asset('assets/img/logo_unz.jpg') }}" width="90" height="100" alt="Logo Université">
    <span class="fs-4 badge bg-secondary">
      UNZ
    </span>
  </a>
  <button class="header-toggler" type="button">
    <span class="header-toggler-icon"></span>
  </button>
  </div>
  
  <div class="container-fluid text-center col-md">
    <h3> <span class="text-success fw-bold">UNZ</span>-<span class="text-primary fw-bold">PEDAGO</span>  </h3>
  </div>

  @auth
      <ul class="header-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" data-coreui-toggle="dropdown" aria-expanded="false">
              <h3>
                <span class="badge bg-success">
                <?php
                  $user = auth()->user();
                  $titre = Titre::findOrFail($user->titre_id);
                  $titre_name = $titre->titre;
                  echo($titre_name." ".$user->name);
                ?>
                </span>
              </h3>
          </a>
          <div class="dropdown-menu pt-0">
            <a class="dropdown-item" href="{{route('user.show',['user'=>auth()->user()->id])}}">
              <svg class="icon mr-2">
                <use xlink:href="{{ url('/icons/sprites/free.svg#cil-user') }}"></use>
              </svg> Profil
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <svg class="icon mr-2">
                <use xlink:href="{{ url('/icons/sprites/free.svg#cil-account-logout') }}"></use>
              </svg><form action="{{ url('/logout') }}" method="POST"> @csrf <button type="submit" class="btn btn-ghost-dark btn-block">Déconnexion</button></form>
            </a>
          </div>
        </li>
        <li class="nav-item d-md-down-none mx-2">
          <a class="nav-link"></a>
        </li>
        <li class="nav-item d-md-down-none mx-2">
          <a class="nav-link"></a>
        </li>
        <li class="nav-item d-md-down-none mx-2">
          <a class="nav-link"></a>
        </li>
      </ul>
      @endauth
      @guest
        <button class="btn btn-warning" disabled> Non Connecter </button>
      @endguest
    
</header>

<!--##################################################################################-->

  <header class="header bg-success">
    <div class="subheader px-3">
      <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <?php $segments = ''; ?>
        @for($i = 1; $i <= count(Request::segments()); $i++)
            <?php $segments .= '/'. Request::segment($i); ?>
            @if($i < count(Request::segments()))
                <li class="breadcrumb-item">{{ Request::segment($i) }}</li>
            @else
                <li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
            @endif
        @endfor
      </ol>
    </div>
  </header>