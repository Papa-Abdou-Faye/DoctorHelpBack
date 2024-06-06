@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')
<div class="pageMedCon">
    {{-- <div class="ajouterAnomalie" style="background:rgb(252, 227, 114); width:  100%; height: 300px;"> --}}
                <form action="{{ route('enregistrerAnomalie.admin') }}" method="POST" style="width: 100%">
                    {{-- pour des mesures de securite de lara vel on ajoute @csrf --}}
                    @csrf
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Pathologie" name="nom">
                    </div>
                    <div class="md-form input-field-text">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea rows="1" placeholder="Description" name="desc" required></textarea>
                    </div>
                    <div class="md-form input-field-text">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea rows="1" placeholder="Traitement" name="traite" required></textarea>
                    </div>
                    <input type="submit" class="btnn2 solide" value="Enregistrer" >
                </form>
    {{-- </div> --}}
</div>
    <div class="tableAno" style="height: 300px;overflow: scroll;">
        <table class="table table-striped" >
            <thead class="en-tete" >
              <tr style="color: white">
                <th scope="col">Image</th>
                <th scope="col">Anomalie</th>
                <th scope="col">Description</th>
                <th scope="col">Traitement</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody style="font-size: 18px; font-family: 'Times New Roman'">
              @foreach ($pathologies as $p )
              <tr >
                <th scope="row"><img src="{{ asset('image/maladie.png') }}" style="width: 30px"> </th>
                <td>{{ $p->nom }}</td>
                <td>{{ $p->desc }}</td>
                <td>{{ $p->traitements }}</td>
                <td style="text-align: center; width: 190px">
                  <a href=""><img src="{{ asset('image/details.png') }}" style="width: 30px;"></a>&ensp;&ensp;
                  <a href=""> <img src="{{ asset('image/modif.png') }}" style="width: 30px"></a> &ensp;&ensp;
                    <a href=""><img src="{{ asset('image/supprim.png') }}" style="width: 30px"></a> 
                </td>
              @endforeach
            </tbody>
          </table>
</div>
@endsection