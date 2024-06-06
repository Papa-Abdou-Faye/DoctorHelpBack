@extends('pere.mere')
@section('content')
@include('naveBarre.navBarMedecin')
@include('naveBarre.navBarreOngletDetail')

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



<div class="pageMedConsultation">
    <table style="height: 400px; margin-left: 50px; width: 90%;">
        <tr>
            <td class="tdtitr">Numéro de consultation</td><td class="tdinf" style="padding-left:30px ">{{ $consultations->numcons }}</td>

            <td class="tdtitr">Prenom</td><td class="tdinf" style="padding-left:30px ">{{ $consultations->prenom}}</td>

            <td class="tdtitr">Nom</td><td class="tdinf" style="padding-left:30px ">{{ $consultations->nom}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Adresse</td><td class="tdinf" style="padding-left:30px ">{{ $consultations->adresse}}</td>

            <td class="tdtitr">Age</td><td class="tdinf" style="padding-left:30px "> {{$consultations->age}} ans</td>

            <td class="tdtitr">Sexe</td><td class="tdinf" style="padding-left:30px ">{{$consultations->sexe}}</td>
        </tr>
        <tr>
            <td class="tdtitr">Statut matrimonial</td><td class="tdinf" style="padding-left:30px ">{{$consultations->status}}</td>

            <td class="tdtitr">Proffession</td><td class="tdinf" style="padding-left:30px ">{{$consultations->profession}}</td>

            <td class="tdtitr">Telephone</td><td class="tdinf" style="padding-left:30px ">+221 {{$consultations->telephone}}</td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: center">
                <a href="{{route('consultation.med')}}"><input type="button" class="btnn2 solide"  value="Terminer" style=" background: rgb(13, 255, 0);"></a>
            </td>
        </tr>

    </table>
    <div style="float: left; margin-top: 10px; margin-left: 300px">
        @if (session()->has('ok'))
        <span class="alert alert-warning" role="alert" style="height: 2px; margin-top: 0%"> {{ session()->get('ok') }}</span>
      @endif
    </div>
</div>
@endsection
