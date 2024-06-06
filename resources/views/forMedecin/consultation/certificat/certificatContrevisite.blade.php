
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
    border: #f0f0f0;
    background-color: rgb(240, 240, 240);
    /* transition: all 0.1s ease; */
    z-index: 41;
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
ConultationForm
*/
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

<div class="popupConsult" id="popupConsult" >
    <form action="{{ route('enrccvmedical') }}" method="POST" class="formIns med">
    <select class="textinsMed solide" name="consultation_id">
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
        <input type="text" name="lieu_nai" style="width: 600px; height: 50px;margin-top: 20px; border: none; float: left;" placeholder="                                                     Lieu de naissance">
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
                    Certificat de contre visite Medicale par Date
                </div>
                @if(session('cvmdcal_first') == true)
                  @foreach ($cmedicales as $cm)
                    <tr style=" width: 100%;height: 40px;  font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirccvmedical/'.$cm->id) }}" class="cl">certificat du  {{ $cm->created_at }}</a></td>
                    </tr>
                  @endforeach
                @endif
            </table>
            @if (Auth::user()->role == 'INFIRMIER')
                <input  type="button" class="textinsMed solide" value="ajouter Certificat Medical" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            @else
                <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="ajouter Certificat Medical" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
            @endif

            <a href="{{route('cM')}}"> <input  type="button" class="textinsMed solide" value="CM" style="background: rgb(24, 1, 126); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 3%;  margin-left: 0%"></a>
            <a href="{{route('cMplus')}}"> <input  type="button" class="textinsMed solide" value="CM+" style="background: rgb(255, 0, 221); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 3%; margin-left: 4%"></a>
            <a href="{{route('cMrepos')}}"> <input  type="button" class="textinsMed solide" value="CR" style="background: rgb(255, 217, 0); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 3%; margin-left: 9%"></a>
            <a href="{{route('cvmedical')}}"> <input  type="button" class="textinsMed solide" value="CV" style="background: rgb(0, 0, 0); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 3%; margin-left: 14%"></a>
            <a href="{{route('ccvmedical')}}"> <input  type="button" class="textinsMed solide" value="CCV" style="background: rgb(111, 202, 7); border-radius: 1px; height: 40px; color: white; bottom: 1%; position: fixed ; width: 3%; margin-left: 19%"></a>
    </div>

    <div class="cons" style="background: none; margin-top: 5px; height: 77%; width: 62%; margin-left: 60px; position: relative; float: left; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; overflow: scroll;" id="div1">
            <table class=" table-hover" style="width: 100%"><?php $aujourdhui = date("d-m-Y"); ?>
                                @if(session('ccvmdcal_first') == true)
                                <tr>
                                    <td colspan="" style="text-align: center">
                                        <img src="{{ asset('image/ministre.png') }}" class="logo logo--wut">
                                    </td>
                                </tr>
                                <tr> &ensp;&ensp;&ensp;&ensp;
                                    <td colspan="" style="text-align: center; ">
                                    &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;<span style="font-size: 30px; text-decoration: underline; font-weight: 700; font-family: 'Times New Roman'">Certificat Médical</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="position: absolute; font-size: 23px; text-align: justify">
                                            Je soussigné, Dr <span style="font-family: Impact; font-style: italic">{{Auth::user()->prenom}} {{Auth::user()->nom}} </span> certifie avoir examniné
                                            Mr/Mme <br> <span style="font-family: Impact; font-style: italic"> {{$patient->prenom}} {{$patient->nom}}  </span> né (e) le  <span style="font-family: Impact; font-style: italic">{{$patient->date_nai}}</span> à
                                            <span style="font-family: Impact; font-style: italic">{{$cmdcal->lieu_nai}} </span> et fait les memes constations.<br>
                                            <span style="font-family: 'Times New Roman'">En foi de quoi ce présent certificat est établi pour servir et valoir ce que de droit.</span><br>
                                            <div style="font-family: 'Times New Roman'; text-align: center"> Fait à Touba le {{ $aujourdhui  }}</div>
                                            <div style="font-family: 'Times New Roman'; text-decoration: underline; text-align: right"> Le Medecin</div>
                                        </div>
                                    </td>
                                </tr>
                            @else
                            <tr>
                                <td colspan="" style="text-align: center">
                                    <img src="{{ asset('image/ministre.png') }}" class="logo logo--wut">
                                </td>
                            </tr>
                            <tr> &ensp;&ensp;&ensp;&ensp;
                                <td colspan="" style="text-align: center; ">
                                &ensp;&ensp; &ensp;&ensp; &ensp;&ensp;<span style="font-size: 30px; text-decoration: underline; font-weight: 700; font-family: 'Times New Roman'">Certificat Médical</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="position: absolute; font-size: 23px; text-align: justify">
                                        Je soussigné, Dr <span style="font-family: Impact; font-style: italic">{{Auth::user()->prenom}} {{Auth::user()->nom}} </span> certifie avoir examniné
                                        Mr/Mme <br> <span style="font-family: Impact; font-style: italic"> :::::::::::::::::::::::::::::::::::::::::::::::::::: </span> né (e) le  <span style="font-family: Impact; font-style: italic">::::::::::::::::::::</span> à
                                        <span style="font-family: Impact; font-style: italic">::::::::::::::::::: </span> et fait les memes constations.<br>
                                        <span style="font-family: 'Times New Roman'">En foi de quoi ce présent certificat est établi pour servir et valoir ce que de droit.</span><br>
                                        <div style="font-family: 'Times New Roman'; text-align: center"> Fait à Touba le {{ $aujourdhui  }}</div>
                                        <div style="font-family: 'Times New Roman'; text-decoration: underline; text-align: right"> Le Medecin</div>
                                    </div>
                                </td>
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


@endsection
