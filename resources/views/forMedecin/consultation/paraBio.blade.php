
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
    /* margin-top: 5px; */
    Text-Align:center;
    place-items:center;

    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;
    transition:transform 0.1s,top 0.1s;
    align-items: center;
    left: 140px;
    top: 13%;
    place-items: center;
}
.open-popupConsult{
  visibility:visible;
    /* position: center; */
    border: 10px outset white;
    margin-top:10%;
    width:52%;
    margin-left: 36%;
    height: 400px;
    background: rgb(240, 240, 240);
    /* background: rgb(191, 190, 190); */
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 47;
}
/*
ConultationForm */



.popupConsult .inp {
    width: 150px;
    height: 35px;
    background-color: white;
    margin-left: 5px;
    border-radius: 25px;
    border: none;
    position: relative;
    margin-top: 5px
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


.popupConsult .inp {
    width: 100px;
    height: 35px;
    background-color: white;
    margin-left: 5px;
    border-radius: 25px;
    border: none;
    position: relative;
    margin-top: 5px
}

.popupConsult .inpMedicament {
    width: 250px;
    height: 35px;
    background-color: white;
    margin-left: 5px;
    border-radius: 25px;
    border: none;
    position: relative;
    margin-top: 5px
}
.popupConsult .poso {
    width: 80px;
    height: 35px;
    background-color: none;
    margin-left: 5px;
    border: none;
    position: relative;
    margin-top: 5px
}
.popupConsult .posoPrise {
    width: 50px;
    height: 35px;
    background-color: none;
    margin-left: 5px;
    border: none;
    position: relative;
    margin-top: 5px
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

<div class="popupConsult" id="popupConsult" style="overflow: scroll;" >
    <form action="{{ route('enrparaBio') }}" method="POST" class="formIns med">
        @csrf
    <select class="textinsMed solide"  name="consultation">
        @foreach ($consultations as $c)
        <?php
            $aujourd8 = time();
            $debut =new DateTime(date('y-m-d h:i:s', $aujourd8));
            // Execution de code
            $fin = $c->created_at;
            $interval = $fin->diff($debut);
           // echo $interval->format('Il s\'est écoulé  %R%S sec');
            //-> Il s'est écoulé +02 sec
            $jour = 2;
        ?>
            @if ( $interval->format('%R%D') < $jour )
                <option><span>Consultation du {{ $c->created_at }}</span></option>
            @endif
        @endforeach
    </select>

        <ul id="container" style="list-style: none; margin: 0%; padding-left: 0px">

        </ul>
        <div style="width: 100%">
            <input type="button" class="btnn2 solide" value="Bilan" onclick="ajouterInput_select()" style="margin-top: 20px; float: left!important;">
            <input type="button" class="btnn2 solide" value="autre" onclick="ajouterInput_text()" style="margin-top: 20px;">
            <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 20px;">
            <input type="button" class="btnn2 solide" onclick="closepopupConsult()" value="Annuler" style="background: red; color: white; margin-top: 20px; float:right!important;">
        </div>
    </form>
</div>
<div class="pageMedConDossier" style="background: none">
    <div class="lien" style="background: rgb(240, 240, 240); left: 25px; height: 70%; width: 30%; position: relative; float: left;overflow: scroll;" >

            {{-- debut popup --}}
            {{-- fin popup --}}
            <table style="" class="table table-hover" >
                <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900;">
                    Paraclinique par Date
                </div>
                @if(session('paraBio_first') == true)
                  @foreach ($paracliniques as $para)
                    <tr style=" width: 100%;height: 40px;  font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirparaBio/'.$para->id) }}" class="cl">Paraclinique du  {{ $para->created_at }}</a></td>
                    </tr>
                  @endforeach
                @endif
            </table>
            @if (Auth::user()->role == 'INFIRMIER')
            <input  type="button" class="textinsMed solide" value="enregistrer paraclinique" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            @else
            <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="enregistrer paraclinique" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            @endif

            <a href="{{route('paraclinique')}}"> <input  type="button" class="textinsMed solide" value="IMAGERIE" style="background: rgb(255, 217, 0); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 15%; margin-left: 75px"></a>
    </div>

    <div class="cons" style="background: none; margin-top: 5px; height: 77%; width: 62%; margin-left: 60px; position: relative; float: left; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; overflow: scroll;" id="div1">
            <table class="table table-hover" style="width: 100%"><?php $aujourdhui = date("d-m-Y"); ?>
                @if(session('paraBio_first') == true)
                        <tr>
                            <td colspan="4" style="text-align: center">
                                {{-- <input type="button" class="textinsMed solide" value="Paraclinique"> --}}
                                <img src="{{ asset('image/ministre.png') }}" class="logo logo--wut">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center">
                                <span style="font-size:20px">BULLETIN D'ANALYSE</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Prenom : </span></td><td> <span> {{$patient->prenom}} </span></td>
                            <td><span>Nom : </span></td><td> <span> {{$patient->nom}} </span></td>
                        </tr>
                        <tr>
                            <td><span>Sexe : </span></td><td> <span> {{$patient->sexe}} </span></td>
                            <td><span>Age : </span></td><td> <span> {{ date_diff(date_create($patient->date_nai), date_create($aujourdhui))->format('%y').' ans' }} </span></td>
                        </tr>
                        <tr>
                            <td><span>Adresse : </span></td><td> <span> {{$patient->adresse}} </span></td>
                            <td colspan="2"><span>Numero de Registre : </span></td>
                        </tr>
                        <tr>
                            <td colspan="1"><span>Diagnostic</span></td>
                            <td colspan="3">{{$paraclinique->diagnostic}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="cl" style="text-align: center;">Analyse(s) demandé(es) le {{ $aujourdhui  }}</td>
                            <td colspan="2" class="cl" style="text-align: center; border-left: 2px solid black">Le prescripteur</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="cl" style=""> <?php $i=1; ?>
                                @foreach ($paracliniquedetails as $item)
                                        &ensp;&ensp;&ensp;&ensp;{{$i}}) {{$item->teste}}<br> <?php $i++; ?>
                                @endforeach
                            </td>
                            <td colspan="2" class="cl" style="text-align: center; border-left: 2px solid black"></td>
                        </tr>

                @endif
            </table>

            <button onclick="printpage()" class="btnn2 solide" style="bottom: 0; position: absolute; float: right!important;">Imprimer</button>
    </div>
</div>
    <script>
        function printpage(){
            let body = document.getElementById('body').innerHTML;
            let d = document.getElementById('div1').innerHTML;
            document.getElementById('body').innerHTML = d;
                // alert(d)
                    window.print();
            document.getElementById('body').innerHTML = body;
        }
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

<script>

    var id = 0;
    var cpt = 0;
    var container;
    window.onload = function(){
        showDate();
        container = document.getElementById("container");
    }

                                                function suppr(bouton){
                                                    if(document.getElementsByTagName("li").length > 10){
                                                        container.removeChild(bouton.parentNode);
                                                        cpt--; id--;
                                                    }
                                                    else{
                                                        alert("Arrete d'en enlevé c'est le dernier !");
                                                    }
                                                }
    //------------------------------------------------------------------------------------------------
    function ajouterInput_text() {
        if(cpt == 9 ){
            alert("DOctor's prendra au plus 10 mediments pour une oredennance.");
        }
    id++;
    cpt++;
    var newL = document.createElement("li");

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name","teste"+cpt);
    input.setAttribute("id", id);
    input.style ="margin-left :0px; padding-left: 0px"
    input.setAttribute("class", 'inpMedicament');
    input.setAttribute("placeholder", "Autre teste");
    newL.appendChild(input);

    var bouton = document.createElement("input");
    bouton.type = "button";
    bouton.style ="background: red; border: none; color: white; width:50px"
        bouton.onclick = function(){
            suppr(this);
        }
    bouton.value = "x";
    newL.appendChild(bouton);
    var input5 = document.createElement("input");
    input5.setAttribute("type", "hidden");
    input5.value = cpt;
    input5.name= "taille";
    newL.appendChild(input5);
    container.appendChild(newL);
    }

    //--------------------------------------------------------------------------------------------

    function ajouterInput_select() {
        if(cpt == 9 ){
            alert("DOctor's prendra au plus 10 mediments pour une oredennance.");
        }
    id++;
    cpt++;
    var newL = document.createElement("li");

    var input = document.createElement("select");

    input.setAttribute("name","teste"+cpt);
    input.setAttribute("id", id);
    input.style ="margin-left :0px; padding-left: 0px"
    input.setAttribute("class", 'inpMedicament');

    var op1 = document.createElement("option");
    op1.text = "Acide Urique";
    input.add(op1);

    var op2 = document.createElement("option");
    op2.text = "Ac Anti Hbc";
    input.add(op2);

    var op3 = document.createElement("option");
    op3.text = "Ac Anti Hbs";
    input.add(op3);

    var op4 = document.createElement("option");
    op4.text = "AgHbe";
    input.add(op4);

    var op5 = document.createElement("option");
    op5.text = "Ac Anti Hbe";
    input.add(op5);

    var op6 = document.createElement("option");
    op6.text = "AgHbs";
    input.add(op6);

    var op7 = document.createElement("option");
    op7.text = "Ac Anti VHD";
    input.add(op7);

    var op8 = document.createElement("option");
    op8.text = "Ac Anti VHC";
    input.add(op8);

    var op9 = document.createElement("option");
    op9.text = "AC Anti RTSH";
    input.add(op9);

    var op10 = document.createElement("option");
    op10.text = "AC Anti CCP";
    input.add(op10);

    var op11 = document.createElement("option");
    op11.text = "ADN Virale B (Charge V.B)";
    input.add(op11);

    var op11 = document.createElement("option");
    op11.text = "Albuminémie";
    input.add(op11);

    var op12 = document.createElement("option");
    op12.text = "A.F.P";
    input.add(op12);

    var op13 = document.createElement("option");
    op13.text = "ASAT / ALAT";
    input.add(op13);

    var op14 = document.createElement("option");
    op14.text = "ASLO";
    input.add(op14);

    var op15 = document.createElement("option");
    op15.text = "Azotémie";
    input.add(op15);

    var op16 = document.createElement("option");
    op16.text = "BW (RPR)";
    input.add(op16);

    var op17 = document.createElement("option");
    op17.text = "Bilirubine Direct";
    input.add(op17);

    var op18 = document.createElement("option");
    op18.text = "Bilirubine Total";
    input.add(op18);

    var op19 = document.createElement("option");
    op19.text = "BnP";
    input.add(op19);

    var op20 = document.createElement("option");
    op20.text = "C.R.P";
    input.add(op20);

    var op21 = document.createElement("option");
    op21.text = "Calcémie";
    input.add(op21);

    var op22 = document.createElement("option");
    op22.text = "Chlamydiae (TR)";
    input.add(op22);

    var op23 = document.createElement("option");
    op23.text = "Cholesterol H.D.L";
    input.add(op23);

    var op24 = document.createElement("option");
    op24.text = "Cholesterol L.D.L";
    input.add(op24);

    var op25 = document.createElement("option");
    op25.text = "Cholesterol Total";
    input.add(op25);

    var op26 = document.createElement("option");
    op26.text = "Créatininémie";
    input.add(op26);

    var op26 = document.createElement("option");
    op26.text = "Culot Urinaire";
    input.add(op26);

    var op28 = document.createElement("option");
    op28.text = "D-Dimeres";
    input.add(op28);

    var op29 = document.createElement("option");
    op29.text = "E.C.B.U + Antibiogramme";
    input.add(op29);

    var op30 = document.createElement("option");
    op30.text = "E.C.B.U. (état frais)";
    input.add(op30);

    var op31 = document.createElement("option");
    op31.text = "Electrophoreses de l'Hb";
    input.add(op31);

    var op32 = document.createElement("option");
    op32.text = "EPS";
    input.add(op32);

    var op33 = document.createElement("option");
    op33.text = "ECBC du LCR";
    input.add(op33);

    var op34 = document.createElement("option");
    op34.text = "ECBC du LP";
    input.add(op34);

    var op35 = document.createElement("option");
    op35.text = "ECBC du LA";
    input.add(op35);

    var op36 = document.createElement("option");
    op36.text = "Fer Sérique";
    input.add(op36);

    var op37 = document.createElement("option");
    op37.text = "F.R. (Facteur Rhumatoïde)";
    input.add(op37);

    var op38 = document.createElement("option");
    op38.text = "FCV";
    input.add(op38);

    var op39 = document.createElement("option");
    op39.text = "Ferritinémie";
    input.add(op39);

    var op40 = document.createElement("option");
    op40.text = "Frottis Sanguin";
    input.add(op40);

    var op41 = document.createElement("option");
    op41.text = "GE (Goutte Epaisse)";
    input.add(op41);

    var op42 = document.createElement("option");
    op42.text = "G.S-R.H. (Groupage)";
    input.add(op42);

    var op43 = document.createElement("option");
    op43.text = "Gamma GT";
    input.add(op43);

    var op44 = document.createElement("option");
    op44.text = "Glycémie a Jeun";
    input.add(op44);

    var op45 = document.createElement("option");
    op45.text = "Glycémie PP";
    input.add(op45);

    var op46 = document.createElement("option");
    op46.text = "Hb. Glyquée";
    input.add(op46);

    var op47 = document.createElement("option");
    op47.text = "Hémoculture";
    input.add(op47);

    var op48 = document.createElement("option");
    op48.text = "lonogramme Sanguin";
    input.add(op48);

    var op49 = document.createElement("option");
    op49.text = "K.A.O.P";
    input.add(op49);

    var op50 = document.createElement("option");
    op50.text = "LDH";
    input.add(op50);

    var op51 = document.createElement("option");
    op51.text = "Lipasemie";
    input.add(op51);

    var op52 = document.createElement("option");
    op52.text = "N.F.S";
    input.add(op52);

    var op53 = document.createElement("option");
    op53.text = "Magnésémie";
    input.add(op53);

    var op54 = document.createElement("option");
    op54.text = "P.V + Antibiogramme";
    input.add(op54);

    var op55 = document.createElement("option");
    op55.text = "PV (état frais)";
    input.add(op55);

    var op56 = document.createElement("option");
    op56.text = "Protidémie";
    input.add(op56);

    var op57 = document.createElement("option");
    op57.text = "Protéinurie des 24h";
    input.add(op57);

    var op58 = document.createElement("option");
    op58.text = "P.S.A total";
    input.add(op58);

    var op59 = document.createElement("option");
    op59.text = "P.S.A libre";
    input.add(op59);

    var op60 = document.createElement("option");
    op60.text = "Phosphatase Alkaline";
    input.add(op60);

    var op60 = document.createElement("option");
    op60.text = "Phosphorémie";
    input.add(op60);

    var op61 = document.createElement("option");
    op61.text = "Progestérone";
    input.add(op61);

    var op62 = document.createElement("option");
    op62.text = "PU + Antibiogramme";
    input.add(op62);

    var op63 = document.createElement("option");
    op63.text = "Rubéole";
    input.add(op63);

    var op64 = document.createElement("option");
    op64.text = "Spermogramme";
    input.add(op64);

    var op65 = document.createElement("option");
    op65.text = "Sérologie rétrovirale (HIV)";
    input.add(op65);

    var op66 = document.createElement("option");
    op66.text = "Sérologie Aspergillaire";
    input.add(op66);

    var op67 = document.createElement("option");
    op67.text = "T.E (Test d Emmel)";
    input.add(op67);

    var op68 = document.createElement("option");
    op68.text = "Triglycerides (TG)";
    input.add(op68);

    var op69 = document.createElement("option");
    op69.text = "Toxoplasmose";
    input.add(op69);

    var op70 = document.createElement("option");
    op70.text = "T.P/INR";
    input.add(op70);

    var op71 = document.createElement("option");
    op71.text = "Troponinel";
    input.add(op71);

    var op72 = document.createElement("option");
    op72.text = "T3 Libre";
    input.add(op72);

    var op73 = document.createElement("option");
    op73.text = "T4 Libre";
    input.add(op73);

    var op74 = document.createElement("option");
    op74.text = "TSH uS";
    input.add(op74);

    var op75 = document.createElement("option");
    op75.text = "TR (Taux de Réticulocyte)";
    input.add(op75);

    var op76 = document.createElement("option");
    op76.text = "VS";
    input.add(op76);

    var op76 = document.createElement("option");
    op76.text = "Vitamine D";
    input.add(op76);

    var op77 = document.createElement("option");
    op77.text = "Widal et Félix";
    input.add(op77);

    // var op78 = document.createElement("option");
    // op78.text = "C.R.P";
    // input.add(op78);

    // var op79 = document.createElement("option");
    // op79.text = "C.R.P";
    // input.add(op79);

    // var op80 = document.createElement("option");
    // op80.text = "C.R.P";
    // input.add(op80);

    // var op81 = document.createElement("option");
    // op81.text = "C.R.P";
    // input.add(op81);

    // var op71 = document.createElement("option");
    // op71.text = "C.R.P";
    // input.add(op71);

    // var op71 = document.createElement("option");
    // op71.text = "C.R.P";
    // input.add(op71);

    // var op71 = document.createElement("option");
    // op71.text = "C.R.P";
    // input.add(op71);

    newL.appendChild(input);

    var bouton = document.createElement("input");
    bouton.type = "button";
    bouton.style ="background: red; border: none; color: white; width:50px"
        bouton.onclick = function(){
            suppr(this);
        }
    bouton.value = "x";
    newL.appendChild(bouton);

    container.appendChild(newL);
    }
</script>


@endsection
