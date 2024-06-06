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


    transform:translate(-50% -50px) scale(0.1);
    /* left:10px; */
    margin-top: 5px;
    Text-Align:center;
    place-items:center;
    width:500px;
    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;
    /* transition:transform 0.1s,top 0.1s; */
    z-index: 60;
}
.open-popupant{

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
    margin-left:5px;
    border-radius: 55px;
    /* border: 1px outset gainsboro; */
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
    /* transition: all 0.1s ease; */
    z-index: 61;
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
            <div class="bk" style="width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900">
                Liste des antecedents
            </div>
              {{-- <tr style="background: #13a3dc; width: 100%; height: 15px; color: white; text-align: center;">
                    <td colspan="4">liste Antecedent</td>
              </tr> --}}
              <tr>
                <td>Pathologies</td>
                <td>Types</td>
                <td>Notes </td>
                <td>supprimer</td>
              </tr>
              @foreach ($antecedents as $antecedent)
              <tr class="cl">
                    <td style="padding: 10px;  width: 400px "> {{ $antecedent->pathologie }}</td>
                    <td style="padding: 10px; ">{{ $antecedent->type }}</td>
                    <td style="padding: 10px; ">{{ $antecedent->note }}</td>
                    <td ><a href="{{ url('supAntecedent/' .$antecedent->id) }}" ><button style='width: 70%; float:left; border-raduis:20%; ' onclick="return confirm('Confirm ?')"class='createe_r'><i class='bx bx-trash'></i>sup</button></a></td>
              </tr>
              @endforeach
        </table>

    </div>

    <div class="cons" style="background: none; height: 100%; width: 50%; position: relative; float: left;">

    </div>

</div>


    <div class="popup" id="popupant" >
        {{-- style="margin-left: 135px;" --}}
      <div class="tableConsul">
        <table style="width: 100%">
            <form action="{{ route('enrAnt') }}" method="POST" class="formIns med">
                @csrf
                    <tr class="bk" style=" width: 100%; color: white; text-align: center;">
                        <td colspan="4" >
                            <input type="button" value="ENREGISTRER Antecedent" style="background: none; border: none; color: white">
                        </td>
                      </tr>

                        <tr>
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px ; width:400px">
                                    <i class='bx bxs-receipt' ></i>
                                    <input type="text" placeholder="Pathologie" name="pathologie" style="width:350px">
                                </div>
                            </td>
                            <td >
                                <div  style="margin-top: 20px">
                                    <i class='bx bxs-receipt' ></i>
                                    <label for="type" style="background: white">Type</label>
                                </div>
                            </td>
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px; width: 160px">
                                    <i class='bx bxs-receipt' ></i>
                                    <select name="type" id="type" style="border:none">
                                        <option>Medicaux</option>
                                        <option>Chirurgicaux</option>
                                        <option>Mode de vie</option>
                                        <option>familiaux</option>
                                    </select>
                                </div>
                            </td>
                            <td >
                                <div class="input-field-insMed" style="margin-top: 20px">
                                    <i class='bx bxs-receipt' ></i>
                                    <input type="text" placeholder="Notes" name="note">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 20px; float: left!important;">
                            </td>
                            <td>
                                <input type="button" class="btnn2 solide" onclick="closepopupant()" value="Annuler" style="background: red; color: white; margin-top: 20px; float: right!important;">
                            </td>
                        </tr>

            </form>
        </table>

        </div>
    </div>

    <div style=" z-index: 50; bottom: 1%; position: fixed; margin-left: 45%; right!important; ">
            <input  type="button" class="textinsMed solide bk" onclick="openpopupant()" value="AJOUTER ANTECEDENT" style=" color: white;">
    </div>

<script>

    let popup=document.getElementById('popupant');

    function openpopupant()
    {
        popup.classList.add("open-popupant");
    }


    function closepopupant(){
        popup.classList.remove("open-popupant");
    }

</script>
@endsection
