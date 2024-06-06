@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')

<div class="divlistMedForAdmin2">
    <input type="submit" class="btnn3 solide" value="+ ajouter Medecin">
</div>
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
        <input type="search" placeholder="  search...">
    </span>
        
</div>
<div class="tableMed" style="height: 450px;overflow: scroll;">
  <table class="table table-hover results" style="margin: 0; padding: 0; ">
        <thead class="en-tete" >
          <tr style="color: white">
            <th scope="col">Image</th>
            <th scope="col">Prenom</th>
            <th scope="col">Nom</th>
            <th scope="col">Age</th>
            <th scope="col">Sexe</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <?php $aujourdhui = date("Y-m-d"); ?>
        <tbody>
          @foreach ($personnel as $p )
          <tr>
            <th scope="row"><img src="{{ asset('image/im2.png') }}" style="width: 30px"> </th>
            <td>{{ $p->prenom}}</td>
            <td>{{ $p->nom}}</td>
            <td>{{ date_diff(date_create($p->date_nai), date_create($aujourdhui))->format('%y').' ans' }}</td>
            <td>{{ $p->sexe}}</td>
            <td>{{ $p->email}}</td>
            <td>
              
                  <button data-toggle="collapse" data-target="#col{{ $p->id }}" class="createe"  style="height: 35px" >
                    {{-- <i class="fa fa-pencil"></i> --}}
                    <i class='bx bx-show-alt' style="width: 40%;"></i>voir
                  </button>
                
                 <button data-toggle="collapse" data-target="#colForm{{ $p->id }}" class="createe" style="height: 35px">
                  <i class='bx bxs-edit' style="width: 40%"></i>edit
                </button>
                <a href="{{ url('supUser/' .$p->id) }}"><button type="submit" class="createe_r" style="height: 35px" title="supprimer medicament" onclick="return confirm('Confirm ?')"><i class='bx bx-trash' style="width: 40%"></i>sup</button> </a>
                    
            </td>
          </tr>
          <tr style="margin: 0; padding: 0;  background: #13a3dc; color: white; " >
            <td colspan="7" style="margin: 0; padding: 0 " >
              <div class="collapse" id="col{{ $p->id }}" style="padding: 0px; margin: 0px;">
                  <table style=" width: 100%">
                      <tr>
                          <td> Prenom :</td> <td style="font-size: 500; font-weight: 700"> {{ $p->prenom}} </td>
                          <td> Date de Naissance :</td> <td style="font-size: 500; font-weight: 700">{{ $p->date_nai}} </td>
                      </tr>
                      <tr>
                          <td> Nom :</td><td style="font-size: 500; font-weight: 700"> {{ $p->nom}} </td>
                          <td> Telephone :</td><td style="font-size: 500; font-weight: 700"> {{ $p->tel}} </td>
                      </tr>
                      <tr>
                          <td> Sexe :</td><td style="font-size: 500; font-weight: 700"> {{ $p->sexe}} </td>
                          <td> Adresse :</td><td style="font-size: 500; font-weight: 700"> {{ $p->adresse}} </td>
                      </tr>
                      <tr>
                          <td> Email :</td> <td style="font-size: 500; font-weight: 700">{{ $p->email}}</td>
                          <td> Statut Matrimmonial :</td> <td style="font-size: 500; font-weight: 700">{{ $p->statut}}</td>
                      </tr>
                  </table>
              </div>
            </td>
          </tr>
          <tr style="margin: 0; padding: 0;  background: #13a3dc; color: white; " >
            <td colspan="7" style="margin: 0; padding: 0 " >
              <div class="collapse" id="colForm{{ $p->id }}" style="padding: 0px; margin: 0px;">
                <form action="{{ route('updatePatient') }}" method="POST"> @csrf
                  <table style=" width: 100%">
                      <tr>
                          <td> Qualite :</td><td style="font-size: 500; font-weight: 700"> <input type="text" name="profession" value="{{$p->qualite}}" class="input-field" style="width: 70%; height: 40px; margin: 0px;"> </td>
                          <td> Telephone :</td><td style="font-size: 500; font-weight: 700"> <input type="number" name="tel" value="{{ $p->tel}}" class="input-field" style="width: 70%; height: 40px; margin: 0px" ></td>
                      </tr>
                      <tr>
                          <td> Adresse :</td><td style="font-size: 500; font-weight: 700"> <input type="text" name="adresse" value="{{$p->adresse}}" class="input-field" style="width: 70%; height: 40px; margin: 0px"></td>
                          <td> Email :</td> <td style="font-size: 500; font-weight: 700"> <input type="email" name="email" value ="{{ $p->email}}" class="input-field" style="width: 70%; height: 40px; margin: 0px"></td>
                      </tr>
                      <tr>
                          <td> Statut Matrimmonial :</td style="font-size: 500; font-weight: 700"> <td> <select name="statut" value="{{ $p->statut}}"class="input-field" style="width: 70%; height: 40px;margin: 0px" ><option>Marié</option><option>celibataire</option></select></td>
                          <td> VALIDER :</td>  <td><button class="createe" style=" background: rgb(21, 255, 5); color: white; width: 300px; height: 30px; "><i class='bx bxs-donate-heart icons'></i>Modifier</button></td>
                          
                      </tr>
                  </table>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
          </tbody>
      </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function () {
     $(".search").keyup(function () {
         var searchTerm = $(".search").val();
         var listItem = $('.results tbody').children('tr');
         var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
 
         $.extend($.expr[':'], {
             'containsi': function (elem, i, match, array) {
                 return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
             }
         });
 
         $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
             $(this).attr('visible', 'false');
         });
 
         $(".results tbody tr:containsi('" + searchSplit + "')").each(function (e) {
             $(this).attr('visible', 'true');
         });
 
         var jobCount = $('.results tbody tr[visible="true"]').length;
         $('.counter').text(jobCount + ' item');
 
         if (jobCount == '0') { $('.no-result').show(); }
         else { $('.no-result').hide(); }
     });
 });
 </script>
@endsection