@extends('unz_st.acceuil.base')
@section('title')
    Création de programme
@endsection
@section('content')

	<div class="row">
		<div class="col-md-2"></div>
    <div class="col-md-8 text-center">
			<x-Error/>
      <div class="card">
        <div class="card-header">
          <div class='text-center display-4'>
            @if(Session::has('message'))
              <div class="row">
                  <div class="col-12">
                      <div class="alert alert-danger" role="alert">
                        <?php
                          echo html_entity_decode( Session::get('message') )
                        ?>
                      </div>
                  </div>
              </div>
            @endif
            <strong>Programme</strong>
          </div>
        </div>
        <div class="card-body">
          @livewire('programme-create')
        </div>
      </div>
    </div>
  </div>
@endsection
