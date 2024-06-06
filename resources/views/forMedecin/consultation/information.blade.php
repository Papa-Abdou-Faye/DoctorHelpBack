@extends('pere.mere')
@section('content')

@if (Auth::user()->role == 'INFIRMIER')
    @include('naveBarre.navBarInf')
@else
    @include('naveBarre.navBarMedecin')
@endif

@include('naveBarre.navBarreOnglet')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<style>
    .popup{
    /* background:#13a3dc; */

    position: center;
    transform:translate(-50% -50px) scale(0.1);
    /* left:10px; */
    margin-top: 5px;
    Text-Align:center;
    place-items:center;
    width:50%;

    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;
    transition:transform 0.1s,top 0.1s;

}
.open-popup{
    visibility:visible;
    /* position: center; */
    /* top:90%;  */
    height: 400px;
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 46;
}
.popupter{
    /* background: red; */

    position: center;
    transform:translate(-50% -50px) scale(0.1);
    /* left:10px; */
    margin-top: 5px;
    Text-Align:center;
    place-items:center;
    width:70%;
    left: 200px;
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

.popupter .input-field-insMed {
    width: 250px;
    height: 35px;
    background-color: white;
    margin-left:5px;
    border-radius: 55px;
    /* border: 1px outset gainsboro; */
    position: relative;
    place-items: center;
}

.popupter .input-field-insMed i {
    text-align: center;
    line-height: 35px;
    color: #acacac;
    font-size: 1.5rem;
}

.popupter .input-field-insMed input {
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
</style>


<div class="popupter" id="popupter" >
    {{-- style="margin-left: 135px;" --}}
  <div class="tableConsul" style="margin-left: 400px;">
    <table style="width: 100%">
        <form action="{{ route('enrAllergies') }}" method="POST" class="formIns med">
            @csrf
                <tr style="background: #13a3dc; width: 100%; height: 15px; color: white; text-align: center;">
                    <td colspan="3" >
                        <input type="button" value="AJOUTER ALLERGIES" style="background: none; border: none; color: white">
                    </td>
                  </tr>
                  <tr >
                        <td colspan="2" >
                            <div class="input-field-insMed" style="margin-top: 20px; width: 100%;">
                                <input type="text"  name="allergie" placeholder="allergie(s)">
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
<div class="pageMedConsultation">
    <table style="height: 500px; margin-left: 15px; float: left;">
        <tr>
            <td class="tdtitr">Prenom</td><td class="tdinf" style="padding-left:30px ">{{ $userpatient->prenom}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Nom</td><td class="tdinf" style="padding-left:30px ">{{ $userpatient->nom}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Adresse</td><td class="tdinf" style="padding-left:30px ">{{ $userpatient->adresse}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Date de Naissance</td><td class="tdinf" style="padding-left:30px ">{{ $userpatient->date_nai}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Sexe</td><td class="tdinf" style="padding-left:30px ">{{$userpatient->sexe}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Statut matrimonial</td><td class="tdinf" style="padding-left:30px ">{{$userpatient->statut}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Email</td><td class="tdinf" style="padding-left:30px ">{{$userpatient->email }}</td>
        </tr>
        <tr>
            <td class="tdtitr">Telephone</td><td class="tdinf" style="padding-left:30px ">+221 {{$userpatient->tel}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Proffession</td><td class="tdinf" style="padding-left:30px ">{{$monPatient->profession}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Allergie(s)</td><td class="tdinf" style="padding-left:30px ">{{$monPatient->allergie}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Groupe sanguin</td><td class="tdinf" style="padding-left:30px ">{{$monPatient->sang }}</td>
        </tr>
        <tr>
            <td class="tdtitr">CNI ou Nemero extrait</td><td class="tdinf" style="padding-left:30px ">{{$monPatient->CNI }}</td>
        </tr>
        <tr>
            <td class="tdtitr">Telephone à prevenir</td><td class="tdinf" style="padding-left:30px ">+221 {{$monPatient->tel_a_prevenir}}</td>
        </tr>
    </table>
    <div style="float: left; margin-top: 10px; margin-left: 300px">
        @if (session()->has('ok'))
        <span class="alert alert-warning" role="alert" style="height: 2px; margin-top: 0%"> {{ session()->get('ok') }}</span>
      @endif
    </div>
    <div style="float: left;">
        <div class="popup" id="popup"  style="margin-left: 135px;">
        <div class="card bg-white shadow rounded-3 p-3 border-0" style="width: 400px; left: 100px;">
            <input type="button" class="textinsMed solide" value="ATTRIBUTION DE CARTE">
          <form action="{{ route('attCarte') }}" method="POST" id="form" >
            @csrf
            <div class="wrapper">
                <div class="scanner"></div>
                <video id="preview"></video>
            </div>
            <input type="hidden" name="cartePatient"  id="cartePatient">
            <input type="button" class="btnn2 solide" onclick="closepopup()" value="IGNORER" style="background: red; color:white; border-radius: 0px">
        </form>
        </div>
    </div>
    <input type="button" class="btnn2 solide" onclick="openpopup()" value="CARTE" style=" float:left; margin-left: 200px;">
    <input type="button" class="btnn2 solide"  value="Allergie" onclick="openpopupter()" style="margin-left: 10px; float:left">
    <a href="{{route('consultation.med')}}"><input type="button" class="btnn2 solide"  value="Terminer" style="margin-left: 10px; float:left; background: rgb(13, 255, 0);"></a>
</div>
</div>
<script>

    let popupter=document.getElementById('popupter');

    function openpopupter()
    {
        popupter.classList.add("open-popupter");
    }


    function closepopupter(){
        popupter.classList.remove("open-popupter");
    }

</script>
<script>

    let popup=document.getElementById('popup');

    function openpopup()
    {
        popup.classList.add("open-popup");
    }


    function closepopup(){
        popup.classList.remove("open-popup");
    }
</script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
      console.log(content);
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
    scanner.addListener('scan', function(c){
      document.getElementById('cartePatient').value = c;
      document.getElementById('form').submit();
    })
  </script>
@endsection
