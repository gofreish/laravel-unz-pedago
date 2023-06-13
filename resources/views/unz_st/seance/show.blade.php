@extends('unz_st.acceuil.base')
@section('title')
    Voir la seance
@endsection
@section('content')
<div>
          <a href="{{route('seance.index')}}">
            <button class="btn btn-lg btn-dark btn-pill "> <i class=" cil-arrow-circle-left "></i></button>
          </a>
     </div>
<!-- /.row-->
<div class="row">
  <div class="col-lg-12 text-center">
    <div class="display-4">
    	<span class="badge badge-secondary">UFR Sciences et Technologies </span>
    </div>
    @if(Session::has('message'))
      <div class="row">
        <div class="col-12">
          <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        </div>
      </div>
    @endif
    <div class="card">
      {{--<div class="card-header"><i class="fa fa-align-justify"></i> <span class="badge badge-secondary"><h5><strong>{{$seance->type_seance}}</strong></h5> </span> </div>--}}
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <tbody>
            <tr>
				      <th>
                <strong>Date</strong>
              </th>
              <th>
                <strong>ECU</strong>
              </th>
              <th>
                <strong>Heure de début</strong>
              </th>
              <th>
                <strong>Heure de fin</strong>
              </th>
              <th>
                <strong>Contenu</strong>
              </th>
            </tr>
            <tr>
              <td>
                <span class="badge bg-secondary">
                	{{$seance->date}}
                </span>
                </td>
                <td>
                	<span class="badge bg-secondary">
                		{{$seance->nom_ecu}}
                	</span>
                </td>
                <td>
                	<span class="badge bg-secondary">
                		{{$seance->hDebut}}
                	</span>
                </td>
                <td>
                	<span class="badge bg-secondary">
                		{{$seance->hFin}}
                	</span>
                </td>
                <td class="" >
                	<span class="col-md-200" >
                		{{$seance->contenu}}
                	</span>
                </td>
            </tr>
          </tbody>
      	</table>
      </div>
     <div class="card-footer">
      	<div class="row justify-content-md-center">
        @if(!$seance->statut)
        @if($seance->enseignant_id===auth()->user()->id)
			<div class="col-md-2">
				<form method="POST" action="{{route('seance.valide', [$seance->id])}}">
					@csrf

            		<button class="btn btn-block btn-success" onclick="return confirm('Ce programme sera validé et ne pourra plus être modifié');"

                 type="submit" value="valider">
                valider
            		</button>
                <input type="hidden" name="marker" value="valider">
            		<input type="hidden" name="_method" value="put" />

				</form>
			</div>
      @endif
      @if($seance->enseignant_id===auth()->user()->id or $seance->delegue_id===auth()->user()->id )
      		<div class="col-md-2">
      			<a href="{{route('seance.edit',['seance'=>$seance->id])}}">
            		<button class="btn btn-block btn-info"  type="button">
                		Modifier
            		</button>
				    </a>
		      </div>
      @endif
      @endif
      </div>


  </div>
  <!-- /.col-->
</div>
<!-- /.row-->
@endsection
