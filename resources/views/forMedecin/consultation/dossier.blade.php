@extends('pere.mere')
@section('content')

@if (Auth::user()->role == 'INFIRMIER')
    @include('naveBarre.navBarInf')
@else
    @include('naveBarre.navBarMedecin')
@endif

@include('naveBarre.navBarreOnglet')
    {{-- consulatation dossier pop up  openpopupConsDosssier() --}}
    <style>
        /* pop consulation */

        .popupConsult{
            /* background:#13a3dc; */

            position: center;
            transform:translate(-50% -50px) scale(0.1);
            left:10px;
            /* margin-top: 5px; */
            Text-Align:center;
            place-items:center;

            /* padding:0  10px 10px; */
            color:#333;
            visibility:hidden;
            transition:transform 0.1s,top 0.1s;

        }
        .open-popupConsult{
          visibility:visible;
            /* position: center; */
            border: 10px outset white;
            margin-top:9%;
            width:51%;
            margin-left: 38%;
            height: 520px;
            background: rgb(240, 240, 240);
            /* background: rgb(191, 190, 190); */
            transform:translate(-50% -50px) scale(1);
            position: relative;
            z-index: 47;
        }
        /*
        ConultationForm */
        .popupConsult {
            align-items: center;

            left: 140px;
            top: 1%;
            border: #f0f0f0;
            background-color: rgb(240, 240, 240);
            /* transition: all 0.1s ease; */
            z-index: 41;
            place-items: center;
        }


        .popupConsult .input-field-insMed {
            width: 300px;
            height: 45px;
            background-color: white;
            margin-left: 25px;
            margin-top: 5px;
            border-radius: 55px;
            border: 1px outset gainsboro;
            position: relative;
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
        <?php
            session_start();
        ?>
        <div class="popupConsult" id="popupConsult" style="overflow: scroll; height: 530px;" ng-app>
          
            <form action="{{ route('enrCon') }}" method="POST" class="formIns med">
                <table class="tableCons">
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
                                <input type="text" style="width: 550px" placeholder=" Plaintes, Symptomes" name="motif" class=" @error('motif') is-invalid @enderror"  value="{{ old('motif') }}" required autocomplete="motif" autofocus>
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
                            <input type="text" placeholder="temperature °c" name="temperature" class=" @error('temperature') is-invalid @enderror"  value="{{ old('temperature') }}" autofocus>
                            </div>
                        </td>

                        <td >
                            <div class="input-field-insMed">
                                <i class='bx bx-street-view'></i>
                                <input type="text" placeholder="taille en m" name="taille" class=" @error('taille') is-invalid @enderror"  value="{{ old('taille') }}" autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field-insMed">
                                <i class='bx bxs-cable-car'></i>
                            <input type="text" placeholder="poids en kg" ng-model="p" name="poids" class=" @error('poids') is-invalid @enderror" value="{{ old('poids') }}" autofocus>
                            </div>
                        </td>

                        <td>
                            <div class="input-field-insMed">
                            <i class='bx bx-equalizer'></i>
                            <input type="text" placeholder="IMC"  name="imc" class=" @error('imc') is-invalid @enderror" value="{{ old('imc') }}" autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field-insMed">
                            <i class='bx bx-equalizer'></i>
                            <input type="text" placeholder="Frequence  cardiaque"  name="frequence" class=" @error('frequence') is-invalid @enderror" value="{{ old('frequence') }}" autofocus>
                            </div>
                        </td>
                        <td >
                            <div class="input-field-insMed">
                                <i class='bx bx-water'></i>
                                <input type="text" placeholder="Tansion Arterielle" name="pression" class=" @error('pression') is-invalid @enderror"  value="{{ old('pression') }}" autofocus>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field-insMed">
                                <i class='bx bxs-hourglass'></i>
                            <input type="text" placeholder="Glycemie"  name="glycemie" class=" @error('glycemie') is-invalid @enderror" value="{{ old('glycemie') }}"  autofocus>
                            </div>
                        </td>
                        <td>
                            <div class="input-field-insMed">
                            <i class='bx bxl-sass'></i>
                            <input type="text" placeholder="Saturation"  name="saturation" class=" @error('saturation') is-invalid @enderror" value="{{ old('saturation') }}"  autofocus>
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
                              <input type="text" placeholder="TDR" name="tdr" class=" @error('tdr') is-invalid @enderror"  value="{{ old('tdr') }}" autofocus>
                          </div>
                      </td>

                      <td>
                          <div class="input-field-insMed">
                            <i class='bx bx-table'></i>
                          <input type="text" placeholder="Autres Examens para cliniques" name="autresParaclinique" class=" @error('autresParaclinique') is-invalid @enderror" value="{{ old('autresParaclinique') }}" autofocus>
                          </div>
                      </td>
                  </tr>
                  <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bx-news'></i>
                            <input type="text" placeholder="Diagnostic" name="diagnostic" class=" @error('diagnostic') is-invalid @enderror"  value="{{ old('diagnostic') }}" autofocus>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bx-command'></i>
                        <input type="text" placeholder="Orientation, Réf et Contre Réf" name="o2r" class=" @error('o2r') is-invalid @enderror" value="{{ old('o2r') }}" autofocus>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bxs-heart'></i>
                            <input type="text" placeholder="Traitement" name="traitement" class=" @error('traitement') is-invalid @enderror"  value="{{ old('traitement') }}" autofocus>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bxl-blogger'></i>
                        <input type="text" placeholder="Besoins PF" name="besoinpf" class=" @error('besoinpf') is-invalid @enderror" value="{{ old('besoinpf') }}" autofocus>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="input-field-insMed"  style="width: 97%">
                        <i class='bx bx-magnet'></i>
                        <input type="text" style="width: 550px"  placeholder="Observations" name="observation" class=" @error('observation') is-invalid @enderror" value="{{ old('observation') }}" autofocus>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="note" id="" cols="30" rows="10" style="width: 600px; height: 100px;margin-top: 20px; border: none" placeholder="                                                          Note de Consultation" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 10px;margin-left: 1px; float: left!important;">

                        <input type="button" class="btnn2 solide" onclick="closepopupConsult()" value="Annuler" style="background: red; color: white; margin-top: 10px; float:right!important;">
                    </td>
                </tr>
            </form>
         </table>
        </div>
    <div class="pageMedConDossier" style="background: none">
        <div class="lien" style="background: rgb(240, 240, 240); left: 25px; height: 66%; width: 30%; position: relative; float: left; overflow: scroll;" >
            <table style="" class="table table-hover" >
                <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900;">
                    consultations par Date
                </div>
                  {{-- <tr style="background: #13a3dc; width: 100%; color: white; text-align: center;">
                        <td>consultations par Date</td>
                  </tr> --}}
                  {{-- <form action="{{ route('voirCons') }}" method="post"> --}}

                  @foreach ($consultations as $consultation)
                    <tr  style=" width: 100%;height: 40px;  font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirCons/' .$consultation->id) }}" class="cl">consultation du  {{ $consultation->created_at }}</a></td>
                    </tr>
                  @endforeach
                {{-- </form> --}}
            </table>

                @if (Auth::user()->role == 'INFIRMIER')
                    <input  type="button" class="textinsMed solide" value="Ajouter Consultation" class="bk" style=" border-radius: 0px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 331px">
                @else
                    <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="Ajouter Consultation" class="bk" style=" border-radius: 0px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 331px">
                @endif
        </div>

        <div class="cons" style="background: none; height: 77%; width: 62%; position: relative; float: left; left: 80px; margin-top: 10px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;overflow: scroll;">
            <table class="table table-hover" style="width: 100%">
                    {{-- @foreach ($consul as $consul) --}}
                @if (session('consultation_trouve')==true)

                    <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 700; font-size: 1500">
                        consultation du {{ $consul->created_at }}
                    </div>
                    <tr>
                        <td>Pliantes et Symptomes</td>
                        <td>{{ $consul->motif }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-size: 20px; font-weight: 500">Constantes</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>{{ $consul->temperature }}</td>
                    </tr>
                    <tr>
                        <td>Taille</td>
                        <td>{{ $consul->taille }}</td>
                    </tr>
                    <tr>
                        <td>Poids</td>
                        <td>{{ $consul->poids }}</td>
                    </tr>
                    <tr>
                        <td>IMC</td>
                        <td>{{ $consul->IMC }}</td>
                    </tr>
                    <tr>
                        <td>Frequence Cardiaque</td>
                        <td>{{ $consul->frequence }}</td>
                    </tr>
                    <tr>
                        <td>Tansion Arterielle</td>
                        <td>{{ $consul->pression }}</td>
                    </tr>
                    <tr>
                        <td>Glycemie</td>
                        <td>{{ $consul->glycemie }}</td>
                    </tr>
                    <tr>
                        <td>Saturation en O2</td>
                        <td>{{ $consul->saturation }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; font-size: 20px; font-weight: 500">Exemens</td>
                    </tr>
                    <tr>
                        <td>TDR</td>
                        <td>{{ $consul->tdr }}</td>
                    </tr>
                    <tr>
                        <td>Autres para cliniques</td>
                        <td>{{ $consul->autresParaclinique }}</td>
                    </tr>
                    <tr>
                        <td>Diagnostic</td>
                        <td>{{ $consul->diagnostic }}</td>
                    </tr>
                    <tr>
                        <td>O2r</td>
                        <td>{{ $consul->o2r }}</td>
                    </tr>
                    <tr>
                        <td>Traitement</td>
                        <td>{{ $consul->traitement }}</td>
                    </tr>
                    <tr>
                        <td>Besoins en PF</td>
                        <td>{{ $consul->besoinpf }}</td>
                    </tr>
                    <tr>
                        <td>Observations</td>
                        <td>{{ $consul->observation }}</td>
                    </tr>
                    <tr>
                        <td>Note de Consulatation</td>
                        <td>{{ $consul->note }}</td>
                    </tr>

                @endif
                @if(session('consultation_trouve') == false)
                    @foreach ($consul as $consul)
                        <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 700; font-size: 1500">
                            consultations du {{ $consul->created_at }}
                        </div>
                        <tr>
                            <td>Pliantes et Symptomes </td>
                            <td>{{ $consul->motif }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Constantes .'.'.'.'.'''.'''.'.'''''''''''</td>
                        </tr>
                        <tr>
                            <td>Temperature</td>
                            <td>{{ $consul->temperature }}</td>
                        </tr>
                        <tr>
                            <td>Taille</td>
                            <td>{{ $consul->taille }}</td>
                        </tr>
                        <tr>
                            <td>Poids</td>
                            <td>{{ $consul->poids }}</td>
                        </tr>
                        <tr>
                            <td>IMC</td>
                            <td>{{ $consul->IMC }}</td>
                        </tr>
                        <tr>
                            <td>Frequence Cardiaque</td>
                            <td>{{ $consul->frequence }}</td>
                        </tr>
                        <tr>
                            <td>Tansion Arterielle</td>
                            <td>{{ $consul->pression }}</td>
                        </tr>
                        <tr>
                            <td>Glycemie</td>
                            <td>{{ $consul->glycemie }}</td>
                        </tr>
                        <tr>
                            <td>Saturation en O2</td>
                            <td>{{ $consul->saturation }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center">Exemens </td>
                        </tr>
                        <tr>
                            <td>TDR</td>
                            <td>{{ $consul->tdr}}</td>
                        </tr>
                        <tr>
                            <td>Autres para cliniques</td>
                            <td>{{ $consul->autresParaclinique }}</td>
                        </tr>
                        <tr>
                            <td>Diagnostic</td>
                            <td>{{ $consul->diagnostic }}</td>
                        </tr>
                        <tr>
                            <td>O2r</td>
                            <td>{{ $consul->o2r }}</td>
                        </tr>
                        <tr>
                            <td>Traitement</td>
                            <td>{{ $consul->traitement }}</td>
                        </tr>
                        <tr>
                            <td>Besoins en PF</td>
                            <td>{{ $consul->besoinpf }}</td>
                        </tr>
                        <tr>
                            <td>Observations</td>
                            <td>{{ $consul->observation }}</td>
                        </tr>
                        <tr>
                            <td>Note de Consulatation</td>
                            <td>{{ $consul->note }}</td>
                        </tr>

                    @endforeach
                @endif
            </table>
        </div>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script> --}}
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
          $(document).ready(function(){
            $("#taille").on("input", function(){
              $("#valTaille").text($(this).val());
            });
          });
          $(document).ready(function(){
            $("#poids").on("input", function(){
              $("#valpoids").text($(this).val());
            });
          });
          </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
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
