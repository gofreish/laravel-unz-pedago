@extends('unz_st.acceuil.base')
@section('title')
    Modification du Programme
@endsection
@section('content')
<div>
          <a href="{{route('programme.show',['programme'=>$id])}}">
            <button class="btn btn-lg btn-dark btn-pill "> <i class=" cil-arrow-circle-left "></i></button>
          </a>
     </div>
	<div class="row">
		<div class="col-md-2"></div>
    <div class="col-md-8 text-center">
			<x-Error/>
      <div class="card">
        <div class="card-header">
          <div class='text-center display-4'>
            <strong>Programme</strong>
          </div>
        </div>
        <div class="card-body">

          @livewire('programme-update', ['ID' => $id])
        </div>
      </div>
    </div>
  </div>
@endsection
