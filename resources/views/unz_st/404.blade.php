@extends('unz_st.errorBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <h1 class="float-left display-3 mr-4">404</h1>
            <h4 class="pt-3">Oops! Vous êtes perdu.</h4>
            <p class="text-muted">La page que vous recherchée est introuvable.</p>
          </div>
          <div class="input-prepend input-group">
            <div class="input-group-prepend"><span class="input-group-text">
              <svg class="c-icon">
                <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-magnifying-glass"></use>
              </svg></span></div>
            <input class="form-control" id="prependedInput" size="16" type="text" placeholder="What are you looking for?"><span class="input-group-append">
              <button class="btn btn-info" type="button">Chercher</button></span>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection