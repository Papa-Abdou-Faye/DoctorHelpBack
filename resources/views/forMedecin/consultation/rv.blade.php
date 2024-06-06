@extends('pere.mere')
@section('content')

@if (Auth::user()->role == 'INFIRMIER')
    @include('naveBarre.navBarInf')
@else
    @include('naveBarre.navBarMedecin')
@endif

@include('naveBarre.navBarreOnglet')


<style>

.popup{
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
.open-popup{
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
       /* RPT rv */
.popup2{
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
.open-popup2{
    visibility:visible;
    /* position: center; */
    /* top:90%;  */
    height: 100px;
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 50;
}

.popup2 .input-field-insMed {
    width: 250px;
    height: 35px;
    background-color: white;
    margin-left:5px;
    border-radius: 55px;
    /* border: 1px outset gainsboro; */
    position: relative;
    place-items: center;
}

.popup2 .input-field-insMed i {
    text-align: center;
    line-height: 35px;
    color: #acacac;
    font-size: 1.5rem;
}

.popup2 .input-field-insMed input {
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
 {{-- tableau rv --}}
<div class="pageMedConDossier" style="background: rgb(240, 240, 240); width: 79%; margin-left: 15px">
    <div class="lien" style="background:white; left: 25px; height: 73%; width: 97%; position: relative; float: left; overflow: scroll;" >

        {{-- debut popup --}}
        {{-- fin popup --}}

        <table style="width: 100%; height: 200px; " class="table table-hover">
                <div class="bk" style="width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900">
                    liste RV
                </div>
              {{-- <tr style="background: #13a3dc; width: 100%;height: 20px; color: white; text-align: center;">
                    <td colspan="3">liste RV</td>
              </tr> --}}
              <tr>
                <td>Date </td>
                <td>Heure</td>
                <td>Note de rv </td>
                <td>Annuler</td>
              </tr>
              @if (session()->has('msg'))
              <tr style="background: rgb(231, 224, 180); height: 50px; text-align: center" >
                <td colspan="4">
                    {{ session()->get('msg') }}
                </td>
            </tr>
            @endif
              @foreach ($rv as $r)
              <tr class="cl">
                    <td style="padding: 10px;  width: 400px "> Rendez-vous du {{ $r->daterv }}</td>
                    <td style="padding: 10px;  ">{{ $r->heurerv }}</td>
                    <td style="padding:  ">{{ $r->note }}</td>
                    <?php
                        $aujourd8 = time();
                        $debut =new DateTime(date('y-m-d h:i:s', $aujourd8));
                        // Execution de code
                        // $fin = $agenda->created_at;
                        $fin = new DateTime($r->daterv);
                        $interval = $fin->diff($debut);
                        // echo $interval->format('Il s\'est écoulé  %R%S sec');
                        //-> Il s'est écoulé +02 sec
                        $jour = 1;
                    ?>
                    @if ($interval->format('%R%D') < $jour)
                            <td> <a href="{{ url('supRv/' .$r->id) }}">
                                <button type="submit" class="createe_r" style="height: 35px"  onclick="return confirm('Confirm ?')">Annuler</button> </a>
                                <button type="submit" class="createe_r" onclick="openpopup2()" style="height: 35px; background: rgb(255, 229, 79)" ><i class='bx bx-command' style="width: 30%"></i>RPT</button>
                            </td>
                    @else
                            <td ><button type='submit' style='width: 50%; float:left; border-raduis:20%; background: greenyellow ' class='createe_r'><i class='bx bx-trash'></i>passé</button></td>
                    @endif

              </tr>
              @endforeach
        </table>

    </div>

    <div class="cons" style="background: none; height: 100%; width: 50%; position: relative; float: left;">

    </div>

</div>
{{-- tableau rv --}}
    <div class="popup" id="popup" >
        {{-- style="margin-left: 135px;" --}}
      <div class="tableConsul">
            <form action="{{ route('enrRv') }}" method="POST" class="formIns med">
                @csrf
                <table style="width: 100%">
                    <tr class="bk" style=" width: 100%; color: white; text-align: center;">
                        <td colspan="3" >
                            <input type="button" value="ENREGISTRER Rendez-Vous" style="background: none; border: none; color: white">
                        </td>
                      </tr>
                      <tr >
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">

                                    <input type="date"  name="daterv" >
                                </div>
                            </td>
                            <td>
                                <div class="input-field-insMed" style="margin-top: 20px">

                                    <input type="time"  name="heurerv"  >
                                </div>
                            </td>
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">
                                    <i class='bx bxs-receipt' ></i>
                                    <input type="text" placeholder="note" name="note">
                                </div>
                            </td>
                            <input type="hidden" name="telephone" value="221{{$patient->tel}}">
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 55px; float: left!important;">
                        </td>
                        <td colspan="2">
                            <input type="button" class="btnn2 solide" onclick="closepopup()" value="Annuler" style="background: red; color: white; margin-top: 55px; float:right!important;">
                        </td>
                    </tr>
                </table>
         </form>
        </div>
    </div>
    <div class="popup2" id="popup2" >
        {{-- style="margin-left: 135px;" --}}
      <div class="tableConsul">

            <form action="{{route('rptRv')}}" method="POST" class="formIns med">
                @csrf
                <table style="width: 100%">
                    <tr class="bk" style=" width: 100%; color: white; text-align: center;">
                        <td colspan="3" >
                            <input type="button" value="Reporter Rendez-Vous" style="background: none; border: none; color: white">
                        </td>
                      </tr>
                      <tr >
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">

                                    <input type="date"  name="daterv" >
                                </div>
                            </td>

                            <td>
                                <div class="input-field-insMed" style="margin-top: 20px">

                                    <input type="time"  name="heurerv"  >
                                </div>
                            </td>
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">
                                    <i class='bx bxs-receipt' ></i>
                                    <input type="text" placeholder="note" name="note">
                                </div>
                            </td>
                            <input type="hidden" name="telephone" value="221{{$patient->tel}}">
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 55px; float: left!important;">
                        </td>
                        <td colspan="2">
                            <input type="button" class="btnn2 solide" onclick="closepopup2()" value="Annuler" style="background: red; color: white; margin-top: 55px; float:right!important;">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div style=" z-index: 50; bottom: 1%; position: fixed; margin-left: 45%; right!important;">

                @if (Auth::user()->role == 'INFIRMIER')
                    <input  type="button" class="textinsMed solide bk" value="Ajouter Rendez-Vous" style="; color: white;">
                @else
                    <input  type="button" class="textinsMed solide bk" onclick="openpopup()" value="Ajouter Rendez-Vous" style="; color: white;">
                @endif
    </div>

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
<script>

    let popup2=document.getElementById('popup2');

    function openpopup2()
    {
        popup2.classList.add("open-popup2");
    }


    function closepopup2(){
        popup2.classList.remove("open-popup2");
    }

</script>
@endsection
