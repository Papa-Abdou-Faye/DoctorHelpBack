
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
    margin-top:22%;
    width:52%;
    margin-left: 46%;
    height: 350px;
    background: rgb(240, 240, 240);
    /* background: rgb(191, 190, 190); */
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 47;
}
/*
ConultationForm */

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
    <form action="{{ route('enrOrd') }}" method="POST" class="formIns med">
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
            $jour = 1;
        ?>
            @if ( $interval->format('%R%D') < $jour )
                <option><span>Consultation du {{ $c->created_at }}</span></option>
            @endif
        @endforeach
    </select>

        <ul id="container" style="list-style: none; margin: 0%; padding-left: 0px">

        </ul>
        <div style="width: 100%">
            <input type="button" class="btnn2 solide" value="Medicament" onclick="ajouterInput_text()" style="margin-top: 20px; float: left!important;">
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
                    Ordonnance par Date
                </div>
                @if(session('ord_first') == true)
                  @foreach ($ordennances as $ordennance)
                    <tr style=" width: 100%;height: 40px;  font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirOrd/' .$ordennance->id) }}" class="cl">Ordonnance du  {{ $ordennance->created_at }}</a></td>
                    </tr>
                  @endforeach
                @endif
            </table>

            @if (Auth::user()->role == 'INFIRMIER')
                <input  type="button" class="textinsMed solide bk" value="Prescrir Ordonnance"  style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            @else
                <input  type="button" class="textinsMed solide bk" onclick="openpopupConsult()" value="Prescrir Ordonnance"  style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            @endif
    </div>

    <div class="cons" style="background: none; overflow: scroll; margin-top: 15px; height: 76%; width: 60%; margin-left: 60px; position: relative; float: left; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;" id="div1">
            <table style="width: 100%">
                <?php $aujourdhui = date("d-m-Y"); ?>
                <?php $aujourd = date("Y-m-d"); ?>
                <tr>
                    <td style="text-align: left; padding-left: 30px">
                        {{-- <img src="{{ asset('image/enteteOrdonnance.jpeg') }}" class="logo logo--wut" style="width: 90%; height: 200px;"> --}}
                         Prenom : <strong> {{ $patient->prenom  }} </strong><br>
                         Nom : <strong> {{ $patient->nom  }} </strong><br>
                         Age : <strong> {{ date_diff(date_create($patient->date_nai), date_create($aujourd))->format('%y').' ans' }} </strong><br>
                    </td>
                    <td style="text-align: center">
                        <img src="{{ asset('image/logoformulair.png') }}" class="logo logo--wut" style=" height: 100px;">
                   </td>
                    <td style="text-align: left; ">
                         Dr <strong> {{ Auth::user()->nom }} </strong> <br>
                         GENERALISTE<br>
                          {{ $aujourdhui }}<br>
                          <strong> +33 221 90 90</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <img src="{{ asset('image/b.png') }}" class="logo logo--wut" style=" width: 100% ; height: 20px;">
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top: 10px;" class="table table-hover">
                <tr class="bk" style=" color : white ;font-style: italic">
                    <td>Medicaments</td>
                    <td>Posologie</td>
                    <td>Nbre Unite</td>
                </tr>
                @if(session('ord_first') == true)
                    @foreach ($ord_medicaments as $medicam)
                    <tr>
                        <td>{{$medicam->medicament}}</td>
                        <td> @if ($medicam->matin)
                                {{$medicam->matin}} (matin)
                             @endif
                             @if ($medicam->midi)
                                {{$medicam->midi}} (midi)
                             @endif
                             @if ($medicam->soire)
                                {{$medicam->soire}} (soire)
                             @endif
                         </td>
                        <td>{{$medicam->quantite}} </td>
                    </tr>
                    @endforeach
                @endif
                {{-- @if(session('ord_first') == false)
                @foreach ($ord_medicaments as $medicam)
                    <tr>
                        <td>{{$medicam->medicament}}</td>
                        <td>{{$medicam->posologie}} fois</td>
                        <td>{{$medicam->unite}} comprime(s)</td>
                        <td>{{$medicam->quantite}} tablette(s)</td>
                    </tr>
                @endforeach
                @endif --}}
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
        var id2 = 0;
        var id3 = 0;
        var id4 = 0;
        var id5 = 0;
        var id6 = 0;
        var cpt = 0;
        var container;
        window.onload = function(){
            showDate();
            container = document.getElementById("container");
        }
        function ajouterInput_text() {
            if(cpt == 9 ){
                alert("DOctor's prendra au plus 10 mediments pour une oredennance.");
            }
        id++;
        id2++;
        id3++;
        id4++;
        cpt++;
        var newL = document.createElement("li");

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name","medicament"+cpt);
        input.setAttribute("id", id);
        input.style ="margin-left :0px; padding-left: 0px"
        input.setAttribute("class", 'inpMedicament');
        input.setAttribute("placeholder", "Medicament");
        newL.appendChild(input);

        var input2 = document.createElement("input");
        input2.setAttribute("type", "text");
        input2.setAttribute("id", id2);
        input2.setAttribute("name","posologie"+cpt);
        input2.setAttribute("class", 'poso');
        input2.setAttribute("value", "Posologie :");
        input2.setAttribute("readonly", "true");
        newL.appendChild(input2);

        var input3 = document.createElement("input");
        input3.setAttribute("type", "text");
        input3.setAttribute("name","matin"+cpt);
        input3.setAttribute("id", id3);
        input3.setAttribute("class", 'posoPrise');
        input3.setAttribute("placeholder", "Matin");
        newL.appendChild(input3);

        var input4 = document.createElement("input");
        input4.setAttribute("type", "text");
        input4.setAttribute("name","midi"+cpt);
        input4.setAttribute("id", id4);
        input4.setAttribute("class", 'posoPrise');
        input4.setAttribute("placeholder", "Midi");
        newL.appendChild(input4);

        var input5 = document.createElement("input");
        input5.setAttribute("type", "text");
        input5.setAttribute("name","soire"+cpt);
        input5.setAttribute("id", id5);
        input5.setAttribute("class", 'posoPrise');
        input5.setAttribute("placeholder", "Soire");
        newL.appendChild(input5);

        var input6 = document.createElement("input");
        input6.setAttribute("type", "text");
        input6.setAttribute("name","quantite"+cpt);
        input6.setAttribute("id", id6);
        input6.setAttribute("class", 'inp');
        input6.setAttribute("placeholder", "Quantite");
        newL.appendChild(input6);

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
        function suppr(bouton){
            if(document.getElementsByTagName("li").length > 10){
                container.removeChild(bouton.parentNode);
                cpt--; id--; id2--; id3--; id4--;
            }
            else{
                alert("Arrete d'en enlevé c'est le dernier !");
            }
        }
    </script>


@endsection
