@extends('pere.mere')
@section('content')
@if (Auth::user()->role == 'INFIRMIER')
    @include('naveBarre.navBarInf')
@else
    @include('naveBarre.navBarMedecin')
@endif
@include('naveBarre.navBarreOngletDetail')
    {{-- consulatation dossier pop up  openpopupConsDosssier() --}}

<?php
    session_start();
?>
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
                        <td><a href="{{ url('voirConsDetail/' .$consultation->id) }}" class="cl">consultation du  {{ $consultation->created_at }}</a></td>
                    </tr>
                  @endforeach
                {{-- </form> --}}
            </table>
            <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="Ajouter Consultation" class="bk" style=" border-radius: 0px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 331px">
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
@endsection
