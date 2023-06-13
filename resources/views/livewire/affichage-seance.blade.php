<div>
    {{-- The whole world belongs to you. --}}

    <div class="card">
    	<div class="row">
    		<div class="col-md-2"></div>
    		<select wire:model="selectedECU" class="col-md-3">
				  <option value="null" selected>
            ECU
          </option>
          @forelse($ECUs as $ECU =>$id)
          	<option value="{{$id}}">
              	{{$ECU}}
          	</option>
			    @empty
				    <p>Pas d'ECU enregistrée</p>
          @endforelse
        </select>
        <div class="col-md-2"></div>
    		<div class="col-md-2">
                @if($contain)
                <form action="{{route('seance.pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="html" value="{{$html}}">
                    <input type="hidden" name="pdfName" value="{{$pdfName}}">
                    <button type="submit" class="btn btn-success">Telecharger</button>
                </form>
                @endif
            </div>
		</div>
	</div>

    <!-- Tableau pour les séances -->
    <div class="card">
      {{--<div class="card-header"><i class="fa fa-align-justify"></i> <span class="badge badge-secondary"><h5><strong>ECU</strong></h5> </span> </div>--}}
      <div class="card-body">
      @if( !is_null($selectedECU))
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Date</th>
              <th>Heure de début</th>
              <th>Heure de fin</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse( $seances as $seance )
              <tr>
                <td>{{$seance->date}}</td>
                <td>{{$seance->hDebut}}</td>
                <td>{{$seance->hFin}}</td>
                @if($seance->statut)
                <td><span class="badge bg-success">Validée</span></td>
                @else
                <td><span class="badge bg-danger">En cours</span></td>
                @endif
                <td>
                 <a href="{{route('seance.show', ['seance'=>$seance->id])}}">
                    <button class="btn btn-block btn-info" type="button">
                      Voir
                    </button>
                  </a>
                </td>
              </tr>

            @empty
            <tr> Pas de séance enregistrée </tr>
            @endforelse
          </tbody>
        </table>

      </div>
      @endif
    </div>
</div>
