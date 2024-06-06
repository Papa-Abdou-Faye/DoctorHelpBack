
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarSecretaire')

<style>

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
    width:40%;
    margin-left: 44%;
    height: 300px;
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
</style>
<div class="popupConsult" id="popupConsult" >
    <form action="{{ route('persoRptSms') }}" method="POST" class="formIns med">
        @csrf
        <table style="margin-top: 50px">
            <tr>
                <td colspan="2">
                    <div  style=" float: right!important">
                        <input type="date"  name="daterv" >
                    </div>
                </td>
                <td colspan="2">
                    <div  style="">
                        <input type="time"  name="heurerv"  >
                    </div>
                </td>
            </tr>
        </table>
            <textarea required name="msg" style="width: 80%; height: 100px;margin-top: 20px; border: none" placeholder="                                        Message" ></textarea>
        <div style="width: 100%">

            <input type="submit" class="btnn2 solide" value="Envoyer" style="margin-top: 20px;">
            <input type="button" class="btnn2 solide" onclick="closepopupConsult()" value="Annuler" style="background: red; color: white; margin-top: 20px; margin-left: 20px">
        </div>
    </form>
</div>
<div class="pageMedConDossier" style="background: white; top:15%">
    <div class="lien" style="background: rgb(240, 240, 240); left: 10px; top: 10px; height: 75%; width: 30%; position: relative; float: left;" >

        <img src="{{ asset('image/secret.jpg') }}" class="logo logo--wut" style="width: 115%; height: 110%;">
    </div>

    <div class="cons" style="background: none; height: 77%; width: 62%; position: relative; float: left; left: 80px; margin-top: 10px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;overflow: scroll;">
        <table class="table table-hover" style="width: 100%"><?php $aujourdhui = date("Y-m-d"); ?>
                    <tr>
                        <td colspan="4" style="text-align: center">
                            {{-- <input type="button" class="textinsMed solide" value="Paraclinique"> --}}
                            <img src="{{ asset('image/ministre.png') }}" class="logo logo--wut">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center">
                            <span>REPORTER RENDEZ-VOUS</span>
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
                        <td><span>Telephone: </span></td><td> <span> {{$patient->tel}} </span></td>
                    </tr>
                    <form action="{{ route('envRpt') }}" method="post">
                        @csrf
                    <tr>
                        <td colspan="2">
                            <div  style=" float: right!important">
                                <input type="date"  name="daterv" >
                            </div>
                        </td>
                        <td colspan="2">
                            <div  style="">
                                <input type="time"  name="heurerv"  >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="cl" style="text-align: center; ">  <input type="submit" class="btnn2 solide" value="Reporter" style=" margin-left: 10px;height: 40px; width: 150px; border-radius: 0px; background: rgb(18, 155, 29);"></form> <input type="button" onclick="openpopupConsult()" class="btnn2 solide" value="Personnaliser sms" style="height: 40px; width: 180px; border-radius: 0px; background:rgb(226, 188, 18) " ><a href="{{route('acc.sec')}}"><input type="submit" class="btnn2 solide" value="Annuler" style=" margin-left: 10px;height: 40px; width: 150px; border-radius: 0px; background: rgb(250, 17, 9)"></a></td>
                    </tr>
        </table>
    </div>
</div>
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

