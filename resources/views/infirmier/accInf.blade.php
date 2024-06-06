@extends('pere.mere')
@section('content')
@include('naveBarre.navBarInf')
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


    /* pop consulation */

    .popupConsult{
        /* background:#13a3dc; */

        position: center;

        left:140px;
        /* margin-top: 5px; */
        Text-Align:center;
        place-items:center;

        /* padding:0  10px 10px; */
        color:#333;
        visibility:hidden;


    }
    .open-popupConsult{
      visibility:visible;
        /* position: center; */
        margin-top:100px;
        width:80%;
        margin-left: 9%;
        height: 400px;
        background: rgb(240, 240, 240);
        /* background: rgb(191, 190, 190); */
        position: relative;
        z-index: 47;
    }
    /*
    ConultationForm */


    .popupConsult .input-field-insMed {
        width: 300px;
        height: 45px;
        background-color: white;
        margin-left: 25px;
        margin-top: 5px;
        border-radius: 55px;
        border: 1px outset gainsboro;
      float:right!important;
    }

    .popupConsult .input-field-insMed i {
        text-align: center;
        line-height: 45px;
        color: #acacac;
        font-size: 1.5rem;
    }

    .popupConsult .input-field-insMed input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        color: black;
    }

    .input-field-insMed input:placeholder-shown {
        color: #aaa;
        font-weight: 500;
    }


    </style>

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
  <table class="table table-hover results" style="margin: 0; padding: 0;  ">
      <thead class="bk cl"  >
        <tr>
        <th scope="col" style="color: white">Numéro c</th>
        <th scope="col" style="color: white">Date et Heure</th>
        <th scope="col" style="color: white">Prenom</th>
        <th scope="col" style="color: white">Sexe</th>
        <th scope="col" style="color: white">Motif</th>
        <th scope="col" style="color: white">Traitant</th>
        <th scope="col" style="color: white">Actions</th>
      </tr>

      <tr class="warning no-result">
        <td colspan="8" style="background: red; text-align: center"><i class="fa fa-warning"></i> Aucun patient trouve </td>
      </tr>
    </thead>
    <tbody>
        @foreach ($consultations as $c)
        <tr class="trow">
            <td>{{$c->numcons}}</td>
            <td>{{$c->created_at}}</td>
            <td>{{$c->prenom}}</td>
            <td>{{$c->sexe }}</td>
            <td>{{Str::limit($c->motif, 25)}}</td>
            <td>Dr {{ $c->nom }}</td>
            <td>
                <button data-toggle="collapse" data-target="#col{{ $c->id}}" class="createe"  style="height: 35px; width: 60px;" >
                    {{-- <i class="fa fa-pencil"></i> --}}
                    <i class='bx bx-show-alt' style="width: 40%;"></i>voir
                  </button>
            </td>
        </tr>

      <tr style="margin: 0; padding: 0; color: white; " class="bk" >
        <td colspan="8" style="margin: 0; padding: 0 " >
          <div class="collapse" id="col{{ $c->id }}" style="padding: 0px; margin: 0px;">
              <table style=" width: 100%" >
                  <tr>
                      <td> Prenom :</td> <td style="font-size: 500; font-weight: 700"> {{ $c->prenom}} </td>
                      <td> Traitant :</td> <td style="font-size: 500; font-weight: 700">Dc {{ $c->nom}} </td>
                      <td> Age ou Date:</td><td style="font-size: 500; font-weight: 700"> {{ $c->statut}} </td>
                  </tr>
                  <tr>
                      <td> Sexe :</td><td style="font-size: 500; font-weight: 700"> {{ $c->sexe}} </td>
                      <td> Adresse:</td><td style="font-size: 500; font-weight: 700"> {{ $c->adresse}} </td>
                      <td> Telephone</td><td style="font-size: 500; font-weight: 700"> {{ $c->telephone}} </td>
                  </tr>
                  <tr>
                      <td> Plaintes et symptomes :</td><td colspan="5" style="font-size: 500; font-weight: 700"> {{ $c->motif}} </td>
                  </tr>
                  <tr>
                    <td> Temperature :</td> <td style="font-size: 500; font-weight: 700">{{ $c->temperature}}</td>
                    <td> Taille :</td> <td style="font-size: 500; font-weight: 700">{{ $c->taille}}</td>
                    <td> Poids :</td> <td style="font-size: 500; font-weight: 700">{{ $c->poids}}</td>
                </tr>
                <tr>
                    <td> IMC :</td> <td style="font-size: 500; font-weight: 700">{{ $c->imc}}</td>
                    <td> Frequence Cardiaque :</td> <td style="font-size: 500; font-weight: 700">{{ $c->frequence}}</td>
                    <td> Tansion Arterielle :</td> <td style="font-size: 500; font-weight: 700">{{ $c->tansion}}</td>
                </tr>
                <tr>
                    <td> Glycemie :</td> <td style="font-size: 500; font-weight: 700">{{ $c->glycemie}}</td>
                    <td> Saturation :</td> <td style="font-size: 500; font-weight: 700">{{ $c->saturation}}</td>
                    <td> TDR :</td> <td style="font-size: 500; font-weight: 700">{{ $c->tdr}}</td>
                </tr>
                <tr>
                    <td>Autres Paraclinique :</td> <td style="font-size: 500; font-weight: 700">{{ $c->autresParaclinique}}</td>
                    <td> Diagnoctic :</td> <td style="font-size: 500; font-weight: 700">{{ $c->diagnostic}}</td>
                    <td> Orientation, Réf et Contre Réf :</td> <td style="font-size: 500; font-weight: 700">{{ $c->o2r}}</td>
                </tr>
                <tr>
                    <td> Traitement :</td> <td style="font-size: 500; font-weight: 700">{{ $c->traitement}}</td>
                    <td> Besoin en PF :</td> <td style="font-size: 500; font-weight: 700">{{ $c->besoinpf}}</td>
                    <td> TDR :</td> <td style="font-size: 500; font-weight: 700">{{ $c->tdr}}</td>
                </tr>
                <tr>
                    <td> Observation :</td><td colspan="4" style="font-size: 500; font-weight: 700"> {{ $c->observation}} </td>
                </tr>
                <tr>
                    <td> Note de consultation:</td><td colspan="4" style="font-size: 500; font-weight: 700"> {{ $c->note}} </td>
                </tr>
                <tr>
                    @if ($c->user_id)
                        <td colspan="5" style="font-size: 500; font-weight: 700; text-align: center">
                            <a href="{{ url('consul2/' .$c->user_id) }}">
                                <input type="submit" class="btnn3 solide"  value="Details" >
                            </a>
                        </td>
                    @else
                        <td colspan="5" style="font-size: 500; font-weight: 700; text-align: center">
                            <a href="{{ url('detailcons/' .$c->id) }}">
                                <input type="submit" class="btnn3 solide"  value="Details" style="background: rgb(255, 208, 0)" >
                            </a>
                        </td>
                    @endif

                </tr>
              </table>
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
 <script>
    let popupConsult=document.getElementById('popupConsult');

    function openpopupConsult()
    {
      popupConsult.classList.add("open-popupConsult");
    }


    function closepopupConsult(){
      popupConsult.classList.remove("open-popupConsult");
    }
</script>
@endsection
