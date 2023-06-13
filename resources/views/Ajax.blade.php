<!-- Ce formulaire sert à sélectionner une UE -->

@extends('dashboard.base')
@section('content')

<div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
        <x-Error/>
            <div class="card">
                <div class="card-header">
                    <div class='text-center display-4'>
                        <strong> Titre </strong>
                    </div>
                </div>
                <div class="card-body">
                  <form class="form-horizontal" action="{{route('ajax')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- #################### -->
                    
                    @livewire('select-ecu')
                    <!-- Bâtiment -->
                    @isset( $batiments )
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="batiment">Bâtiment</label>
                      <div class="col-md-9">
                        <select class="form-control" id="batiment" name="batiment" onchange="choisi()">
                          <option value="">Aucun
                            </option>
                          @foreach( $batiments as $batiment )
                            <option value="{{$batiment->id}}">{{ $batiment->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    @endisset
                        
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary" type="submit"> 
                        Terminer
                      </button>
                            <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>


@endsection