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
.open-popupter{
    visibility:visible;
    height: 180px;width:900px;
    position: relative;
    left: 400px;
    top: 235px;
    z-index: 60;
}

.popup .input-field-insMed {
    width: 250px;
    height: 35px;
    background-color: white;
    margin-left:2px;
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
    position: center;
    border: #f0f0f0;
    background-color: rgb(240, 240, 240);
    z-index: 41;
    height: 200px;
    place-items: center;
}

</style>


 {{-- tableau antecedent --}}
 <div class="pageMedConDossier" style="background: rgb(240, 240, 240); width: 79%; margin-left: 15px">
    <div class="lien" style="background:white; left: 25px; height: 73%; width: 97%; position: relative; float: left; overflow: scroll;" >

        {{-- debut popup --}}
        {{-- fin popup --}}
        <table style="width: 100%; height: 200px; " class="table table-hover">
            <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900">
                liste Terrain
            </div>
              {{-- <tr style="background: #13a3dc; width: 100%; color: white; text-align: center;">
                    <td colspan="3">liste Terrain</td>
              </tr> --}}
              <tr >
                <td>Pathologie</td>
                <td>Famille</td>
                <td>Date de debut </td>
                <td>Supprimer</td>
              </tr>
              @foreach ($terrains as $terrain)
              <tr class="cl">
                    <td style="padding: 10px;  width: 400px "> {{ $terrain->pathologie }}</td>
                    <td style="padding: 10px;  ">{{ $terrain->famille }}</td>
                    <td style="padding: 10px;  ">{{ $terrain->datedebut }}</td>
                    <td ><a href="{{ url('supTerrain/' .$terrain->id) }}" ><button style='width: 70%; float:left; border-raduis:20%;' onclick="return confirm('Confirm ?')" class='createe_r'><i class='bx bx-trash'></i>sup</button></a></td>
              </tr>
              @endforeach
        </table>

    </div>

    <div class="cons" style="background: none; height: 100%; width: 50%; position: relative; float: left;">

    </div>

</div>


    <div class="popup" id="popupter" >
        {{-- style="margin-left: 135px;" --}}
      <div class="tableConsul">
        <table style="width: 100%">
            <form action="{{ route('enrTer') }}" method="POST" class="formIns med">
                @csrf
                    <tr class="bk" style=" width: 100%; height: 15px; color: white; text-align: center;">
                        <td colspan="3" >
                            <input type="button" value="ENREGISTRER TERRAIN" style="background: none; border: none; color: white">
                        </td>
                      </tr>
                      <tr >

                            <td>
                                <div class="input-field-insMed" style="margin-top: 20px; width: 380px">

                                    <input type="text" placeholder="Pathologie" name="pathologie" style="width: 350px" >

                                </div>
                            </td>
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">

                                    <input type="date"  name="datedebut" >
                                </div>
                            </td>

                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">
                                    <i class='bx bxs-receipt' ></i>
                                    <input type="text" placeholder="Famille" name="famille">
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

<div style=" z-index: 50; bottom: 1%; position: fixed; margin-left: 45%; right!important; ">
        <input  type="button" class="textinsMed solide" onclick="openpopupter()" value="AJOUTER TERRAIN" class="bk" style=" color: white;">
</div>

<script>

    let popup=document.getElementById('popupter');

    function openpopupter()
    {
        popup.classList.add("open-popupter");
    }


    function closepopupter(){
        popup.classList.remove("open-popupter");
    }

</script>
@endsection
