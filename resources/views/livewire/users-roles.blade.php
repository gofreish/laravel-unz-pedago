{{--Note : pour gerer l affaire avec les roles il faut utiliser les fenetres modales --}}
<div>
    {{-- Stop trying to control. --}}
    <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
              <div class="card">
                <div class="card-header">
                    <select wire:model="selectedRole" class="col-md-3">
                        <option value="all" selected>
                            Tous
                        </option>
                        @forelse($roles as $name)
                            <option value="{{$name}}">
                                {{$name}}
                            </option>
                        @empty
                        <p>Pas de R&ocircles enregistrée</p>
                        @endforelse
                    </select>
                </div>
                <div class="card-body">
                @if ( $contain )
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Email</th>
                      <th>T&eacute;l&eacute;phone</th>
                      <th>R&ocircles</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($usersList as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telephone }}</td>
                        <td>
                          @foreach ( $user->menuroles as $role)
                            <span class="badge bg-success">{{$role}}</span>
                          @endforeach
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                @else
                  @if ( !is_null($selectedRole) )
                    <div class="display-4">
                        <span class="text-warning">Personne n'a le rôle {{$selectedRole}}</span>
                    </div>
                  @else
                    <div class="display-4">
                        <span class="text-secondary">Sélectionner un rôle et appuyez sur afficher</span>
                    </div>
                  @endif

                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
