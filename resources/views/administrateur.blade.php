@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')
@endsection
.popupter{
    /* background: red; */

    position: center;
    transform:translate(-50% -50px) scale(0.1);
    /* left:10px; */
    margin-top: 5px;
    Text-Align:center;
    place-items:center;
    width:20%;

    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;
    transition:transform 0.1s,top 0.1s;

}
.open-popupter{
    visibility:visible;
    /* position: center; */
    /* top:90%;  */
    height: 100px;
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 50;
}

.popup .input-field-insMed {
    width: 250px;
    height: 35px;
    background-color: white;
    margin-left:5px;
    border-radius: 55px;
    /* border: 1px outset gainsboro; */
    position: relative;
    place-items: center;
}

.popup .input-field-insMed i {
    text-align: center;
    line-height: 35px;
    color: #acacac;
    font-size: 1.5rem;
}

.popup .input-field-insMed input {
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
.tableConsul{
    align-items: center;
    position: fixed;
    left: 440px;
    top: 37%;
    border: #f0f0f0;
    background-color: rgb(240, 240, 240);
    /* transition: all 0.1s ease; */
    z-index: 41;
    height: 200px;
    place-items: center;
}

<div class="popupter" id="popupter" >
    {{-- style="margin-left: 135px;" --}}
  <div class="tableConsul">
    <table style="width: 100%">
        <form action="{{ route('enrTer') }}" method="POST" class="formIns med">
            @csrf
                <tr style="background: #13a3dc; width: 100%; height: 15px; color: white; text-align: center;">
                    <td colspan="3" >
                        <input type="button" value="ENREGISTRER TERRAIN" style="background: none; border: none; color: white">
                    </td>
                  </tr>
                  <tr >
                        <td >
                            <div class="input-field-insMed" style="margin-top: 20px">
                                <input type="text"  name="datedebut" >
                            </div>
                        </td>
                 </tr>
                 <tr>
                    <td>
                        <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 20px; float: left!important;">
                    </td>
                    <td colspan="2">
                        <input type="button" class="btnn2 solide" onclick="closepopupter()" value="Annuler" style="background: red; color: white; margin-top: 20px; float: right!important;">
                    </td>
                 </tr>
        </form>
    </table>
  </div>
</div>

/////////////////////////////// para BIO


@extends('pere.mere')
@section('content')
@include('naveBarre.navBarMedecin')
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
    margin-top:10%;
    width:52%;
    margin-left: 36%;
    height: 500px;
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
    position: fixed;
    left: 140px;
    top: 0%;
    border: #f0f0f0;
    background-color: rgb(240, 240, 240);
    /* transition: all 0.1s ease; */
    z-index: 41;
    place-items: center;
}


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

</style>

<div class="popupConsult" id="popupConsult" style="overflow: scroll;">
    <form action="{{ route('enrparaclinique') }}" method="POST" class="formIns med">
    <select class="textinsMed solide" value="enregistrer paraclinique">
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
            $debutSignature =new DateTime(date('y-m-d h:i:s', $aujourd8));
        ?>
            @if ( $interval->format('%R%D') < $jour )
                <option><span>Consultation du {{ $c->created_at }}</span></option>
            @endif
        @endforeach
    </select>
        @csrf
        {{-- <br>EXEMEN DES SELLES<br>coprologie<br>Parasitologie --}}

        <table style="height: 300px; overflow: scroll; font-size: 11px; text-align: left; width: 100%">
            <tr>
                <td><span style="text-decoration: underline">GROUPAGE SANGUIN </span> <br><input type="checkbox" name="" > groupe <br><input type="checkbox" name="" > Rhésus <br><input type="checkbox" name="" > RAI <br><input type="checkbox" name="" > Phénotype Rhésus <br><input type="checkbox" name="" > Coombs Indirect <br><input type="checkbox" name="" > Coombs direct<br><span style="text-decoration: underline">EXEMEN DES URINES</span><br><input type="checkbox" name="" > ECBU<br><input type="checkbox" name="" > ATB gramme<br><input type="checkbox" name="" > Test de grossesse</td>
                <td><span style="text-decoration: underline">LONOGRAMME SANGUIN</span><br><input type="checkbox" name="" > Na<sup>+</sup> <br><input type="checkbox" name="" > K+ <br><input type="checkbox" name="" > C-<br><input type="checkbox" name="" > Calcium<br><input type="checkbox" name="" > Réserve Alcaline<br><input type="checkbox" name="" > Phosphore<br><input type="checkbox" name="" > Magnésium<br><input type="checkbox" name="" > Magnésium érythrocytaire <br><input type="checkbox" name="" > Protéines<br><input type="checkbox" name="" > Acide urique</td>
                <td><span style="text-decoration: underline">LONOGRAMME URINAIRE</span><br><input type="checkbox" name="" > Diurèse<br><input type="checkbox" name="" > Na<sup>+</sup><br><input type="checkbox" name="" > K+<br><input type="checkbox" name="" > cl<sup>-</sup><br><input type="checkbox" name="" > Calcium<br><input type="checkbox" name="" > Phosphore<br><input type="checkbox" name="" > Urée<br><span style="text-decoration: underline"> EXEMEN DES SELLES</span><br><input type="checkbox" name="" > coprologie<br><input type="checkbox" name="" > Parasitologie</td>
                <td><span style="text-decoration: underline">SEROLOGIE ET IMMUNOLOGIE</span><br><input type="checkbox" name="" > VDRL<br><input type="checkbox" name="" > TPHA<br><input type="checkbox" name="" > Hépatite A<br><input type="checkbox" name="" > Hétatite B<br><input type="checkbox" name="" > Antigène Hbs<br><input type="checkbox" name="" > Antigène Hbe<br><input type="checkbox" name="" > Anticorps Anti Hbc<br><input type="checkbox" name="" > Anticorps Anti Hbs<br><input type="checkbox" name="" > Anticorps Anti Hbe<br><input type="checkbox" name="" > Hétatite C<br><input type="checkbox" name="" > ASLD</td>
            </tr>
            <tr>
                <td><span style="text-decoration: underline">Hématologie/infectiologie</span><br><input type="checkbox" name="" > NFS<br><input type="checkbox" name="" > Plaquette<br><input type="checkbox" name="" > Electorophorèse de l'hémoglobine<br><input type="checkbox" name="" > Réticulocytes<br><input type="checkbox" name="" > VS<br><input type="checkbox" name="" > CRP<br><input type="checkbox" name="" > Protéines<br><input type="checkbox" name="" > Acide urique<br> <span style="text-decoration: underline">BILAN D'HEMOSTASE</span><br><input type="checkbox" name="" > TP<br><input type="checkbox" name="" > INR<br><input type="checkbox" name="" > TCK<br><input type="checkbox" name="" > Fibrinogéne<br><input type="checkbox" name="" > D-Dimères</td>
                <td><span style="text-decoration: underline">BILAN HORMONAL</span><br><input type="checkbox" name="" > Prolactine<br><input type="checkbox" name="" > FSH<br><input type="checkbox" name="" > Oestradiol<br><input type="checkbox" name="" > BHCG<br><input type="checkbox" name="" > T3<br><input type="checkbox" name="" > T4<br><input type="checkbox" name="" > TSH us <br><span style="text-decoration: underline">Divers</span><br><input type="checkbox" name="" > PSA<br><input type="checkbox" name="" > Phosphatase acide<br><input type="checkbox" name="" > Vitamine D<br><input type="checkbox" name="" > CPK<br><input type="checkbox" name="" > Troponines<br><input type="checkbox" name="" > BNP<br></td>
                <td><span style="text-decoration: underline">FONCTION HEPATITE ET PANCREATIQUE</span><br><input type="checkbox" name="" > ASAT<br><input type="checkbox" name="" > ALAT<br><input type="checkbox" name="" > Phosphatase Alcaline<br><input type="checkbox" name="" > Gamma GT<br><input type="checkbox" name="" > Bilirubine libre et conjuguée<br><input type="checkbox" name="" > 5' Nucléotidase<br><input type="checkbox" name="" > Amylase<br><input type="checkbox" name="" > Lipase<br><input type="checkbox" name="" > Electrophorèse protéines<br><span style="text-decoration: underline">BILAN MARTIAL</span><br><input type="checkbox" name="" > Fer Sérique<br><input type="checkbox" name="" > CTF<br><input type="checkbox" name="" > Ferritine<br><input type="checkbox" name="" > Transferrine</td>
                <td><span style="text-decoration: underline">BILAN GLYCEMIQUE </span><br><input type="checkbox" name="" > Glycémie à jeun<br><input type="checkbox" name="" > Hyperglycémie provoquée<br><input type="checkbox" name="" > Hémaglobine glyquée <br> <span style="text-decoration: underline">BILAN LIPIDIQUE</span><br><input type="checkbox" name="" > Choléterols total<br><input type="checkbox" name="" > Choléterols HDL<br><input type="checkbox" name="" > Choléterols LDL<br><input type="checkbox" name="" > Triglycérides<br> <br><span style="text-decoration: underline; text-align: center">Aures ...</span> <br><br><br><br><br></td>
            </tr>
            <tr>
                <td></td>
                <td> <input type="checkbox" name="" > Pro BNP</td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <div style="width: 100%">
            <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 20px;">
            <input type="button" class="btnn2 solide" onclick="closepopupConsult()" value="Annuler" style="background: red; color: white; margin-top: 20px; margin-left: 20px">
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
                @if(session('para_first') == true)
                  @foreach ($paracliniques as $para)
                    <tr style=" width: 100%;height: 40px;  font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirparaclinique/'.$para->id) }}" class="cl">Paraclinique du  {{ $para->created_at }}</a></td>
                    </tr>
                  @endforeach
                @endif
            </table>
            <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="enregistrer paraclinique" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            <a href="{{route('paraclinique')}}"> <input  type="button" class="textinsMed solide" value="Imagerie" style="background: rgb(255, 217, 0); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 15%; margin-left: 75px"></a>
    </div>

    <div class="cons" style="background: none; margin-top: 5px; height: 77%; width: 62%; margin-left: 60px; position: relative; float: left; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; overflow: scroll;" id="div1">

            <table  style="height: 300px; overflow: scroll; font-size: 13px; text-align: left; width: 850px; color: #02195a"><?php $aujourdhui = date("Y-m-d"); ?>
                <section style="float: left">
                    <div style="background: rgb(68, 0, 131); width: 415px; height: 100px; border: 2px solid rgb(68, 0, 131);">
                        <div style=" width: 415px; height: 100px; border: 2px solid rgb(131, 26, 0); margin-left: 415px ">
                            <span style="text-decoration: underline; color: #02195a; font-size: 800; font-weight: 500; margin-left: 140px">Bilan Biologique</span><br>
                            <span style="margin-left: 30px">Prenom : </span> <span>{{$patient->prenom}}</span><br>
                            <span style="margin-left: 30px">Nom&ensp;&ensp;&ensp;: </span> <span>{{$patient->nom}}</span> &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;le {{Str::limit($para->created_at, 10) }}<br>
                            <span style="margin-left: 30px">Sexe &ensp;&ensp;&ensp;: </span> <span>{{$patient->sexe}}</span>
                        </div>
                    </div>
                </section>
                <tr>
                    <td><span style="text-decoration: underline">GROUPAGE SANGUIN </span> <br><input type="checkbox" name="group" checked > groupe <br><input type="checkbox" name="" > Rhésus <br><input type="checkbox" name="" > RAI <br><input type="checkbox" name="" > Phénotype Rhésus <br><input type="checkbox" name="" > Coombs Indirect <br><input type="checkbox" name="" > Coombs direct<br><span style="text-decoration: underline">EXEMEN DES URINES</span><br><input type="checkbox" name="" > ECBU<br><input type="checkbox" name="" > ATB gramme<br><input type="checkbox" name="" > Test de grossesse</td>
                    <td><span style="text-decoration: underline">LONOGRAMME SANGUIN</span><br><input type="checkbox" name="" > Na<sup>+</sup> <br><input type="checkbox" name="" > K+ <br><input type="checkbox" name="" > C-<br><input type="checkbox" name="" > Calcium<br><input type="checkbox" name="" > Réserve Alcaline<br><input type="checkbox" name="" > Phosphore<br><input type="checkbox" name="" > Magnésium<br><input type="checkbox" name="" > Magnésium érythrocytaire <br><input type="checkbox" name="" > Protéines<br><input type="checkbox" name="" > Acide urique</td>
                    <td><span style="text-decoration: underline">LONOGRAMME URINAIRE</span><br><input type="checkbox" name="" > Diurèse<br><input type="checkbox" name="" > Na<sup>+</sup><br><input type="checkbox" name="" > K+<br><input type="checkbox" name="" > cl<sup>-</sup><br><input type="checkbox" name="" > Calcium<br><input type="checkbox" name="" > Phosphore<br><input type="checkbox" name="" > Urée<br><span style="text-decoration: underline"> EXEMEN DES SELLES</span><br><input type="checkbox" name="" > coprologie<br><input type="checkbox" name="" > Parasitologie</td>
                    <td><span style="text-decoration: underline">SEROLOGIE ET IMMUNOLOGIE</span><br><input type="checkbox" name="" > VDRL<br><input type="checkbox" name="" > TPHA<br><input type="checkbox" name="" > Hépatite A<br><input type="checkbox" name="" > Hétatite B<br><input type="checkbox" name="" > Antigène Hbs<br><input type="checkbox" name="" > Antigène Hbe<br><input type="checkbox" name="" > Anticorps Anti Hbc<br><input type="checkbox" name="" > Anticorps Anti Hbs<br><input type="checkbox" name="" > Anticorps Anti Hbe<br><input type="checkbox" name="" > Hétatite C</td>
                </tr>
                <tr>
                    <td><span style="text-decoration: underline">Hématologie/infectiologie</span><br><input type="checkbox" name="" > NFS<br><input type="checkbox" name="" > Plaquette<br><input type="checkbox" name="" > Electorophorèse de l'hémoglobine<br><input type="checkbox" name="" > Réticulocytes<br><input type="checkbox" name="" > VS<br><input type="checkbox" name="" > CRP<br><input type="checkbox" name="" > Protéines<br><input type="checkbox" name="" > Acide urique<br> <span style="text-decoration: underline">BILAN D'HEMOSTASE</span><br><input type="checkbox" name="" > TP<br><input type="checkbox" name="" > INR<br><input type="checkbox" name="" > TCK<br><input type="checkbox" name="" > Fibrinogéne<br><input type="checkbox" name="" > D-Dimères</td>
                    <td><span style="text-decoration: underline">BILAN HORMONAL</span><br><input type="checkbox" name="" > Prolactine<br><input type="checkbox" name="" > FSH<br><input type="checkbox" name="" > Oestradiol<br><input type="checkbox" name="" > BHCG<br><input type="checkbox" name="" > T3<br><input type="checkbox" name="" > T4<br><input type="checkbox" name="" > TSH us <br><span style="text-decoration: underline">Divers</span><br><input type="checkbox" name="" > PSA<br><input type="checkbox" name="" > Phosphatase acide<br><input type="checkbox" name="" > Vitamine D<br><input type="checkbox" name="" > CPK<br><input type="checkbox" name="" > Troponines<br><input type="checkbox" name="" > BNP<br></td>
                    <td><span style="text-decoration: underline">FONCTION HEPATITE ET PANCREATIQUE</span><br><input type="checkbox" name="" > ASAT<br><input type="checkbox" name="" > ALAT<br><input type="checkbox" name="" > Phosphatase Alcaline<br><input type="checkbox" name="" > Gamma GT<br><input type="checkbox" name="" > Bilirubine libre et conjuguée<br><input type="checkbox" name="" > 5' Nucléotidase<br><input type="checkbox" name="" > Amylase<br><input type="checkbox" name="" > Lipase<br><input type="checkbox" name="" > Electrophorèse protéines<br><span style="text-decoration: underline">BILAN MARTIAL</span><br><input type="checkbox" name="" > Fer Sérique<br><input type="checkbox" name="" > CTF<br><input type="checkbox" name="" > Ferritine<br><input type="checkbox" name="" > Transferrine</td>
                    <td><input type="checkbox" name="" > ASLD<br><span style="text-decoration: underline">BILAN GLYCEMIQUE </span><br><input type="checkbox" name="" > Glycémie à jeun<br><input type="checkbox" name="" > Hyperglycémie provoquée<br><input type="checkbox" name="" > Hémaglobine glyquée <br> <span style="text-decoration: underline">BILAN LIPIDIQUE</span><br><input type="checkbox" name="" > Choléterols total<br><input type="checkbox" name="" > Choléterols HDL<br><input type="checkbox" name="" > Choléterols LDL<br><input type="checkbox" name="" > Triglycérides<br> <br><span style="text-decoration: underline; text-align: center"><input type="checkbox" name="" > Aures ...</span> <br><br><br><br><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td> <input type="checkbox" name="" > Pro BNP</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>

            <button onclick="printpage()" class="btnn2 solide" style="bottom: -1; position: absolute; float: right!important;">Imprimer</button>
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


@endsection
