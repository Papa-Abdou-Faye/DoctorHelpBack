@extends('pere.mere')
@section('content')
@include('naveBarre.navBarSecretaire')


<div class="divlistMedForAdminbar">
   <ul style="padding-top: 10px;">
        <li class="bartitre">
           <span class="nav-l">Nom </span> <input type="checkbox" name="filtreNom" placeholder="papaabdouafey">
        </li>
        <li class="bartitre">
            <span class="nav-l">Prenom </span> <input type="checkbox" name="filtrePrenom">
        </li>
        <li class="bartitre">
            <span class="nav-l"> mail </span> <input type="checkbox" name="filtreAge">
        </li>
        <li class="bartitre">
            <span class="nav-l">sexe </span> <input type="checkbox" name="filtreSexe">
        </li>
   </ul>
    <span class="bartitreSearch">
        <i class='bx bx-search-alt-2 icons'></i>
        <input type="search" id="tableSearch" class="search form-control" placeholder="  search...">
    </span>

</div>

<div class="tableMed" style="margin: 0px; padding: 0px; height: 450px;overflow: scroll;" >

  <table class="table table-hover results" style="margin: 0; padding: 0; ">
      <thead class="bk cl"  >
        <tr>
        <th scope="col" style="color: white">Image</th>
        <th scope="col" style="color: white">Prenom</th>
        <th scope="col" style="color: white">Nom</th>
        <th scope="col" style="color: white">Sexe</th>
        <th scope="col" style="color: white">Email</th>
        <th scope="col" style="color: white">Telephone</th>
      </tr>
    </thead>
      <tbody>
      @foreach ($medecins as $p )
      <tr class="trow">
        <td scope="row"><img src="{{ asset('image/im2.png') }}" style="width: 30px"> </td>
        <td>{{ $p->prenom}}</td>
        <td>{{ $p->nom}}</td>
        <td>{{ $p->sexe}}</td>
        <td>{{ $p->email}}</td>
        <td>{{ $p->tel}}</td>
      </tr>
      @endforeach
      </tbody>
  </table>

</div>


@endsection
