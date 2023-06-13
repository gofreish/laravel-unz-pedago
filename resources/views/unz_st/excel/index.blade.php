@extends('unz_st.acceuil.base')
@section('title')
    Fichier excel
@endsection
@section('content')

  <div class="row">
        <div>
            <x-Error/>
        </div>
    <div class="d-flex justify-content-center text-center">
        <div class="col-md-5 ">
            <span class="badge bg-primary d-4">Importez un fichier excel pour l'enregistrer en base de données</span>
        
            <form action="{{route('excel.import')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="input-group m-2">
                    <span class="input-group-text">Type de donn&eacute;es</span>
                    <select name="data_type" id="data_type" class="form-control">
                        <option></option>
                        <option value="user">Utilisateurs</option>
                        <option value="student">Etudiants</option>
                    </select>
                </div>
                <div class="input-group m-2">
                  <input class="form-control" type="file" name="excel_file" id="excel_file" placeholder="Choisissez un fichier excel">
                </div>
                <button type="submit" class="btn btn-success">Importer</button>
            </form>
        </div>
        
    </div>
  </div>
@endsection
