@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')
<div class="pageMedCon">
    {{-- <div class="ajouterAnomalie" style="background:rgb(252, 227, 114); width:  100%; height: 300px;"> --}}
                <form action="{{ route('ajouterStricture') }}" method="POST" style="width: 100%">
                    {{-- pour des mesures de securite de lara vel on ajoute @csrf --}}
                    @csrf
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nom" name="nom">
                    </div>
                    <div class="md-form input-field-text">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <input type="text" required name="adresse" placeholder="Adresse">
                    </div>
                    <div class="md-form input-field-text">
                        <i class="fas fa-pencil-alt prefix"></i>
                       <input type="number" required name="telephone" placeholder="Telephone">
                    </div>
                    <input type="submit" class="btnn2 solide" value="Enregistrer" >
                </form>
    {{-- </div> --}}
</div>
    <div class="tableAno" style="height: 300px;overflow: scroll;">
        <table class="table table-striped" >
            <thead class="en-tete" >
              <tr style="color: white">
                <th scope="col">Nom</th>
                <th scope="col">Adresse</th>
                <th scope="col">Telephone</th>

              </tr>
            </thead>
            <tbody style="font-size: 18px; font-family: 'Times New Roman'">
              @foreach ($strictures as $s )
              <tr >
                <td>{{ $s->nom }}</td>
                <td>{{ $s->Adresse }}</td>
                <td>{{ $s->telephone }}</td>
              @endforeach
            </tbody>
          </table>
</div>
@endsection
