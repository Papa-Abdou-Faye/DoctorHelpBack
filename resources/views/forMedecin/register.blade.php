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
<div class="popupConsult" id="popupConsult" style="overflow: scroll; height: 525px;" ng-app>
    <div style="float: left; width: 350px">
    <form action="{{ route('enrConReg') }}" method="POST" class="formIns med">
    <table style="margin-top: 35%">
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bxs-user'></i>
                <input type="text" placeholder="Prenom" name="prenom" class=" @error('prenom') is-invalid @enderror"  value="{{ old('temperature') }}"  autocomplete="nom" autofocus>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bxs-user'></i>
                <input type="text" placeholder="Nom" id="nom" name="nom" class=" @error('nom') is-invalid @enderror" value="{{ old('nom') }}"  autocomplete="nom" autofocus>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bx-female-sign'></i>
                    <select name="sexe" class=" @error('sexe') is-invalid @enderror" value="{{ old('sexe') }}" required autocomplete="sexe" autofocus style="border: none; background: none; width: 75%;">
                        <option>Femme</option>
                        <option>Homme</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bx-home'></i>
                    <input type="text" placeholder="age"  name="age" class=" @error('age') is-invalid @enderror" value="{{ old('age') }}"  autocomplete="age" autofocus>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bx-group'></i>
                    <select name="status" class=" @error('status') is-invalid @enderror" value="{{ old('status') }}" required autocomplete="statut" autofocus style="border: none; background: none; width: 75%;">
                        <option>Marié</option>
                        <option>celibataire</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bx-home'></i>
                    <input type="text" placeholder="Adresse"  name="adresse" class=" @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}"  autocomplete="adresse" autofocus>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bx-home'></i>
                    <input type="text" placeholder="Profession"  name="profession" class=" @error('profession') is-invalid @enderror" value="{{ old('profession') }}"  autocomplete="profession" autofocus>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-field-insMed">
                    <i class='bx bxs-phone-incoming'></i>
                    +221<input type="number" placeholder="Telephone" name="telephone" class=" @error('tel') is-invalid @enderror" value="{{ old('tel') }}"  autocomplete="tel" autofocus>
                    </div>
            </td>
        </tr>
        <tr>
            <td >
                <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 10px;margin-left: 1px; float: left!important;">

                <input type="button" class="btnn2 solide" onclick="closepopupConsult()" value="Annuler" style="background: red; color: white; margin-top: 10px; float:right!important;">

                <button style=" border: none; background: none"><i class='bx bx-alarm icons' style="color: rgb(14, 158, 50) ;font-size: 2.4rem;"></i></button>
            </td>
      </tr>
    </table>
</div>
<div style="float: left">
    <table class="">

          @csrf
              <tr>

                  <td colspan="2" style="">
                      <input type="button" style=" width: 105%;height: 40px;  font-weight: 600; font-size: 900; border: none" class="Cl bk" value="ENREGISTRER CONSULTATION">
                  </td>
                </tr>
                  <tr>
                      <td colspan="2">
                          <div class="input-field-insMed" style="width: 97%">
                             <i class='bx bxs-message-dots'></i>
                              <input type="text" style="width: 550px" placeholder=" Plaintes, Symptomes" name="motif" class=" @error('motif') is-invalid @enderror"  value="{{ old('motif') }}"  autocomplete="motif" autofocus>
                          </div>
                      </td>

              </tr>
              <tr style="height: 0px">
                  <td colspan="2">Constantes--------------------------------------------------------------------------------</td>
              </tr>
              <tr>
                  <td>
                      <div class="input-field-insMed">
                      <i class='bx bxs-brightness-half'></i>
                      <input type="text" placeholder="temperature °c" name="temperature" class=" @error('temperature') is-invalid @enderror"  value="{{ old('temperature') }}"  autocomplete="nom" autofocus>
                      </div>
                  </td>

                  <td >
                      <div class="input-field-insMed">
                          <i class='bx bx-street-view'></i>
                          <input type="text" placeholder="taille en m" id="taille" name="taille" class=" @error('taille') is-invalid @enderror"  value="{{ old('taille') }}" autocomplete="adresse" autofocus>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td>
                      <div class="input-field-insMed">
                          <i class='bx bxs-cable-car'></i>
                      <input type="text" placeholder="poids en kg" id="poids" name="poids" class=" @error('poids') is-invalid @enderror" value="{{ old('poids') }}"  autocomplete="poids" autofocus>
                      </div>
                  </td>

                  <td>
                      <div class="input-field-insMed">
                      <i class='bx bxs-objects-vertical-bottom'></i> <span id="valTaille"></span> / <span id="valpoids"></span>
                      <input type="text" placeholder="IMC"  name="imc" class=" @error('imc') is-invalid @enderror" value=""  autocomplete="noteDiagnostique" autofocus readonly>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td>
                      <div class="input-field-insMed">
                      <i class='bx bx-equalizer'></i>
                      <input type="text" placeholder="Frequence  cardiaque"  name="frequence" class=" @error('frequence') is-invalid @enderror" value="{{ old('frequence') }}"  autocomplete="noteDiagnostique" autofocus>
                      </div>
                  </td>
                  <td >
                      <div class="input-field-insMed">
                          <i class='bx bx-water'></i>
                          <input type="text" placeholder="Tansion Arterielle" name="pression" class=" @error('pression') is-invalid @enderror"  value="{{ old('pression') }}"  autocomplete="adresse" autofocus>
                      </div>
                  </td>
              </tr>
              <tr>
                  <td>
                      <div class="input-field-insMed">
                          <i class='bx bxs-hourglass'></i>
                      <input type="text" placeholder="Glycemie"  name="glycemie" class=" @error('frequence') is-invalid @enderror" value="{{ old('frequence') }}"  autocomplete="noteDiagnostique" autofocus>
                      </div>
                  </td>
                  <td>
                      <div class="input-field-insMed">
                      <i class='bx bxl-sass'></i>
                      <input type="text" placeholder="Saturation"  name="saturation" class=" @error('frequence') is-invalid @enderror" value="{{ old('frequence') }}"  autocomplete="noteDiagnostique" autofocus>
                      </div>
                  </td>
              </tr>
              <tr style="height: 0x">
                  <td colspan="2">Examen------------------------------------------------------------------------------------</td>
              </tr>
              <tr>
                <td >
                    <div class="input-field-insMed">
                      <i class='bx bx-bulb'></i>
                        <input type="text" placeholder="TDR" name="tdr" class=" @error('tension') is-invalid @enderror"  value="{{ old('tension') }}"  autocomplete="adresse" autofocus>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                      <i class='bx bx-table'></i>
                    <input type="text" placeholder="Autres Examens para cliniques" name="autresParaclinique" class=" @error('noteDiagnostique') is-invalid @enderror" value="{{ old('noteDiagnostique') }}"  autocomplete="noteDiagnostique" autofocus>
                    </div>
                </td>
            </tr>
            <tr>
              <td >
                  <div class="input-field-insMed">
                      <i class='bx bx-news'></i>
                      <input type="text" placeholder="Diagnostic" name="diagnostic" class=" @error('tension') is-invalid @enderror"  value="{{ old('tension') }}" autocomplete="adresse" autofocus>
                  </div>
              </td>

              <td>
                  <div class="input-field-insMed">
                      <i class='bx bx-command'></i>
                  <input type="text" placeholder="Orientation, Réf et Contre Réf" name="o2r" class=" @error('noteDiagnostique') is-invalid @enderror" value="{{ old('noteDiagnostique') }}" autocomplete="noteDiagnostique" autofocus>
                  </div>
              </td>
          </tr>
          <tr>
              <td >
                  <div class="input-field-insMed">
                      <i class='bx bxs-heart'></i>
                      <input type="text" placeholder="Traitement" name="traitement" class=" @error('tension') is-invalid @enderror"  value="{{ old('tension') }}" autocomplete="adresse" autofocus>
                  </div>
              </td>

              <td>
                  <div class="input-field-insMed">
                      <i class='bx bxl-blogger'></i>
                  <input type="text" placeholder="Besoins PF" name="besoinpf" class=" @error('noteDiagnostique') is-invalid @enderror" value="{{ old('noteDiagnostique') }}" autocomplete="noteDiagnostique" autofocus>
                  </div>
              </td>
          </tr>
          <tr>
              <td colspan="2">
                  <div class="input-field-insMed"  style="width: 97%">
                  <i class='bx bx-magnet'></i>
                  <input type="text" style="width: 550px"  placeholder="Observations" name="observation" class=" @error('noteDiagnostique') is-invalid @enderror" value="{{ old('noteDiagnostique') }}"  autocomplete="noteDiagnostique" autofocus>
                  </div>
              </td>
          </tr>
          <tr>
              <td colspan="2">
                  <input type="text" name="note" style="width: 600px; height: 100px;margin-top: 20px; margin-left: 40px; border: none" placeholder="                                                          Note de Consultation" >
              </td>
          </tr>


   </table>
</div>
</form>
  </div>
<div class="tableMed" style="margin: 0px; padding: 0px; height: 450px;overflow: scroll;" >
    <table style="width: 100%;">
        <tr style="text-align: center">
            <td><input type="submit" class="btnn3 solide"  value="+ Consultation" onclick="openpopupConsult()" ></td>
        </tr>

     </table>
  <table class="table table-hover results" style="margin: 0; padding: 0;  ">
      <thead class="bk cl"  >
        <tr>
        <th scope="col" style="color: white">Numéro c</th>
        <th scope="col" style="color: white">Date et Heure</th>
        <th scope="col" style="color: white">Prenom</th>
        <th scope="col" style="color: white">Nom</th>
        <th scope="col" style="color: white">Sexe</th>
        <th scope="col" style="color: white">Motif</th>
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
            <td>{{$c->nom}}</td>
            <td>{{$c->sexe }}</td>
            <td>{{Str::limit($c->motif, 20)}}</td>
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
                      <td> Nom :</td> <td style="font-size: 500; font-weight: 700">{{ $c->nom}} </td>
                      <td> Age :</td><td style="font-size: 500; font-weight: 700"> {{ $c->age}} </td>
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
                    <td> Traitement :</td> <td colspan="3" style="font-size: 500; font-weight: 700">{{ $c->traitement}}</td>
                    <td> Besoin en PF :</td> <td style="font-size: 500; font-weight: 700">{{ $c->besoinpf}}</td>
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
