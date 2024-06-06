@extends('pere.mere')
@section('content')
@include('naveBarre.navBarMedecin')
<style>
  .results tr[visible='false'],
.no-result {
    display: none;
}

.results tr[visible='true'] {
    display: table-row;
}

.counter {
    padding: 8px;
    color: #ccc;
}
</style>
<div class="divlistMedForAdmin2">
  <a href="{{ route('ins.med') }}">
    <input type="submit" class="btnn3 solide" value="+ ajouter Patient">
  </a>
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
        <th scope="col" style="color: white">Age</th>
        <th scope="col" style="color: white">Gp Sanguin</th>
        <th scope="col" style="color: white">Sexe</th>
        <th scope="col" style="color: white">Email</th>
        <th scope="col" style="color: white">Actions</th>
      </tr>

      <tr class="warning no-result">
        <td colspan="8" style="background: red; text-align: center"><i class="fa fa-warning"></i> Aucun patient trouve </td>
      </tr>
    </thead>
      <tbody>
        <?php $aujourdhui = date("Y-m-d"); ?>
      @foreach ($patient as $p )
      <tr class="trow">
        <th scope="row"><img src="{{ asset('image/im2.png') }}" style="width: 30px"> </th>
        <td>{{ $p->prenom}}</td>
        <td>{{ $p->nom}}</td>
        <td>{{ date_diff(date_create($p->date_nai), date_create($aujourdhui))->format('%y').' ans' }}</td>
        <td>{{ $p->sang}}</td>
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

      <tr style="margin: 0; padding: 0; color: white; " class="bk" >
        <td colspan="8" style="margin: 0; padding: 0 " >
          <div class="collapse" id="col{{ $p->id }}" style="padding: 0px; margin: 0px;">
              <table style=" width: 100%" >
                  <tr>
                      <td> Prenom :</td> <td style="font-size: 500; font-weight: 700"> {{ $p->prenom}} </td>
                      <td> Date de Naissance :</td> <td style="font-size: 500; font-weight: 700">{{ $p->date_nai}} </td>
                      <td> Profession: :</td><td style="font-size: 500; font-weight: 700"> {{ $p->profession}} </td>
                  </tr>
                  <tr>
                      <td> Nom :</td><td style="font-size: 500; font-weight: 700"> {{ $p->nom}} </td>
                      <td> Telephone :</td><td style="font-size: 500; font-weight: 700"> {{ $p->tel}} </td>
                      <td> Groupe Sanguin :</td><td style="font-size: 500; font-weight: 700"> {{ $p->sang}} </td>
                  </tr>
                  <tr>
                      <td> Sexe :</td><td style="font-size: 500; font-weight: 700"> {{ $p->sexe}} </td>
                      <td> CNI :</td><td style="font-size: 500; font-weight: 700"> {{ $p->CNI}} </td>
                      <td> Adresse :</td><td style="font-size: 500; font-weight: 700"> {{ $p->adresse}} </td>
                  </tr>
                  <tr>
                      <td> Email :</td> <td style="font-size: 500; font-weight: 700">{{ $p->email}}</td>
                      <td> Statut Matrimmonial :</td> <td style="font-size: 500; font-weight: 700">{{ $p->statut}}</td>
                      <td> A prevenir :</td> <td style="font-size: 500; font-weight: 700">{{ $p->tel_a_prevenir}}</td>
                  </tr>
                  <tr>
                      <td colspan="6" style=" text-align: center">
                        <a href="{{ url('consul/' .$p->id) }}"><button class="createe" style=" background: white; color: #13a3dc; width: 100px;  "><i class='bx bxs-donate-heart icons'></i>Conulter</button></a>
                      </td>
                  </tr>
              </table>
          </div>
        </td>
      </tr>
      <tr style="margin: 0; padding: 0; color: white; " class="bk">
        <td colspan="8" style="margin: 0; padding: 0 " >
          <div class="collapse" id="colForm{{ $p->id }}" style="padding: 0px; margin: 0px;">
            <form action="{{ route('updatePatient') }}" method="POST"> @csrf <input type="hidden" name="id" value="{{$p->id}}">
              <table style=" width: 100%">
                  <tr>
                      <td> Profession: :</td><td style="font-size: 500; font-weight: 700"> <input type="text" name="profession" value="{{$p->profession}}" class="input-field" style="width: 70%; height: 40px; margin: 0px;"> </td>
                      <td> Telephone :</td><td style="font-size: 500; font-weight: 700"> <input type="number" name="tel" value="{{ $p->tel}}" class="input-field" style="width: 70%; height: 40px; margin: 0px" ></td>
                  </tr>
                  <tr>
                      <td> Adresse :</td><td style="font-size: 500; font-weight: 700"> <input type="text" name="adresse" value="{{$p->adresse}}" class="input-field" style="width: 70%; height: 40px; margin: 0px"></td>
                      <td> Email :</td> <td style="font-size: 500; font-weight: 700"> <input type="email" name="email" value ="{{ $p->email}}" class="input-field" style="width: 70%; height: 40px; margin: 0px"></td>
                  </tr>
                  <tr>
                      <td> Statut Matrimmonial :</td style="font-size: 500; font-weight: 700"> <td> <select name="statut" value="{{ $p->statut}}"class="input-field" style="width: 70%; height: 40px;margin: 0px" ><option>Marié</option><option>celibataire</option></select></td>
                      <td> A prevenir :</td> <td style="font-size: 500; font-weight: 700"> <input type="number" name="tel_a_prevenir" value="{{ $p->tel_a_prevenir}}" class="input-field" style="width: 70%; height: 40px;margin: 0px"></td>
                  </tr>
                  <tr>
                    <td> CNI :</td> <td style="font-size: 500; font-weight: 700"> <input type="number" name="CNI" value="{{ $p->CNI}}" class="input-field" style="width: 70%; height: 40px;margin: 0px"></td>
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
         var listItem = $('.results tbody').children('.trow');
         var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

         $.extend($.expr[':'], {
             'containsi': function (elem, i, match, array) {
                 return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
             }
         });

         $(".results tbody .trow").not(":containsi('" + searchSplit + "')").each(function (e) {
             $(this).attr('visible', 'false');
         });

         $(".results tbody .trow:containsi('" + searchSplit + "')").each(function (e) {
             $(this).attr('visible', 'true');
         });

         var jobCount = $('.results tbody .trow[visible="true"]').length;
         $('.counter').text(jobCount + ' item');

         if (jobCount == '0') { $('.no-result').show(); }
         else { $('.no-result').hide(); }
     });
 });
 </script>

@endsection
