<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="container-fluid">

        <div class="card">
            <div class="row">
                <div class="col-md-2"></div>
                    <select wire:model="selectedRole" class="col-md-3">
                        <option value="null" selected>
                            Choisir un rôle
                        </option>
                        @forelse($roles as $name)
                            <option value="{{$name}}">
                                {{$name}}
                            </option>
                        @empty
                        <p>Pas de rôle enregistrée</p>
                        @endforelse
                    </select>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        @if( $contain )
                        <form method="POST" action="{{route('user.pdf')}}">
                            @csrf
                            <button class="btn btn-block btn-success" type="submit" >
                                Telecharger
                            </button>
                            <input type="hidden" name="html" value="{{$html}}" />
                            <input type="hidden" name="pdfName" value="{{'Liste de '.$selectedRole}}" />
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="animated fadeIn">

          @if ( !is_null($users) )
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
              <div class="card">
                  <div class="card-header">
                    <i class="fa fa-align-justify"></i>{{ __('Tous le(s) '.$selectedRole) }}</div>
                  <div class="card-body">
                      <table class="table table-responsive-sm table-striped">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>E-mail</th>
                          <th>Roles</th>
                          <th>Email vérifiée le</th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($users as $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->menuroles }}</td>
                            <td>{{ $user->email_verified_at }}</td>
                            <td>
                              <a href="{{ url('/user/' . $user->id) }}" class="btn btn-block btn-primary">Voir</a>
                            </td>
                            <td>
                              <a href="{{ url('/user/' . $user->id . '/edit') }}" class="btn btn-block btn-primary">Modifier</a>
                            </td>
                            <td>
                              @if( auth()->user()->id !== $user->id )
                              <form action="{{ route('user.destroy', $user->id ) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button class="btn btn-block btn-danger">Supprimer</button>
                              </form>
                              @endif
                            </td>
                          </tr>
                        @empty
                          <tr>
                              <td>
                                    <h3 class="text text-warning">
                                        Il n y a pas de {{$selectedRole}}
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
</div>
