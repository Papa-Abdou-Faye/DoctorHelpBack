
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarSecretaire')

    {{-- consulatation dossier pop up  openpopupConsDosssier() --}}
<style>
/* pop consulation */

.popupConsult{
    /* background:#13a3dc; */

    transform:translate(-50% -50px) scale(0.1);
    /* margin-top: 5px; */
    Text-Align:center;
    place-items:center;

    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;

    left: 140px;
    top: 5%;
    border: #f0f0f0;
    background-color: rgb(240, 240, 240);
    /* transition: all 0.1s ease; */
    z-index: 47;

}
.open-popupConsult{
  visibility:visible;
    /* position: center; */
    border: 10px outset white;
    margin-top:15%;
    width:40%;
    margin-left: 45%;
    height: 250px;
    background: rgb(240, 240, 240);
    /* background: rgb(191, 190, 190); */
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 67;
}
/*
ConultationForm */
.inp {
    width: 150px;
    height: 35px;
    background-color: white;
    margin-left: 5px;
    border-radius: 25px;
    border: none;
    position: relative;
    margin-top: 5px
}

.input-field-insMed i {
    text-align: center;
    line-height: 45px;
    color: #acacac;
    font-size: 1.5rem;
}

.input-field-insMed input {
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
.popupConsult2{
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
    border: #f0f0f0;
    background-color: rgb(240, 240, 240);
    /* transition: all 0.1s ease; */
    z-index: 47;
    place-items: center;

}
.open-popupConsult2{
  visibility:visible;
    /* position: center; */
    border: 10px outset white;
    width:47%;
    margin-left: 40%;
    height: 250px;
    background: rgb(240, 240, 240);
    /* background: rgb(191, 190, 190); */
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 67;
}
</style>
<div class="popupConsult" id="popupConsult">
    <form action="{{ route('ajoutAuQueu') }}" method="POST" class="formIns med">
        @csrf
            <input type="text" name="prenom" required style="width: 300px; height: 50px;margin-top: 20px;  border: none" placeholder="                             Prenom" >
            <input type="text" name="nom" required style="width: 300px; height: 50px;margin-top: 20px; border: none" placeholder="                              Nom" >
        <div style="width: 100%">
            <input type="submit" class="btnn2 solide" value="Enregistrer" style="margin-top: 20px;">
            <input type="button" class="btnn2 solide" onclick="closepopupConsult()" value="Annuler" style="background: red; color: white; margin-top: 20px; margin-left: 20px">
        </div>
    </form>
</div>
<div class="pageMedConDossier" style="background: white; top:15%">
    <div class="lien" style="background: rgb(240, 240, 240); left: 25px; height: 70%; width: 30%; position: relative; float: left;overflow: scroll;" >

            {{-- debut popup --}}
            {{-- fin popup --}}
            <table style="" class="table table-hover" >
                <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900;">
                    Liste par Date
                </div>
                @if(session('list_first') == true)
                  @foreach ($listes as $l)
                    <tr style=" width: 100%;height: 40px;  font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirqueu/'.$l->id) }}" class="cl">Liste du {{ $l->nom }}</a></td>
                    </tr>
                  @endforeach
                @endif
            </table>
            {{-- <a href="{{route('Queu')}}"> <input  type="button" class="textinsMed solide" value="Ajouter une liste" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%"></a> --}}
            <input  type="button" onclick = "openpopupConsult2()" class="textinsMed solide" value="Ajouter une liste" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
    </div>

    <div class="cons" style="background: none; height: 77%; width: 62%; position: relative; float: left; left: 80px; margin-top: 10px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;overflow: scroll;">
        <table class="table table-hover" style="width: 100%">
                {{-- @foreach ($consul as $consul) --}}
            @if (session('list_first')==true)

                <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 700; font-size: 1500">
                    Liste du {{ $liste->nom }}
                </div>
                <tr>
                    <td>Numéro</td>
                    <td>Prenom</td>
                    <td>Nom</td>
                </tr>
                <?php $i= 1; ?>
                @foreach ($persoQueu as $item)
                    <tr>
                        <td>{{ $i}}</td>
                        <td>{{ $item->prenom}}</td>
                        <td>{{ $item->nom }}</td>
                    </tr>
                    <?php $i++ ; ?>
                @endforeach
            @endif
        </table>
         <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="Ajouter une personne" class="bk" style=" border-radius: 1px; height: 40px; color: white; bottom: 2%; position: fixed ; width: 50%"></a>
    </div>
</div>
<div class="popupConsult2" id="popupConsult2"  style=" height: 250px; overflow: scroll;">
            <table class="table table-hover" style="width: 100%">
                {{-- @foreach ($consul as $consul) --}}


                    <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 700; font-size: 1500">
                        Créer une liste pour un personnel soignant
                    </div>
                    <tr>
                        <td>Qualité</td>
                        <td>Prenom</td>
                        <td>Nom</td>
                    </tr>
                    <?php $i= 1; ?>
                    @foreach ($medecins as $ite)
                        <tr>
                            <td> <a href="{{ url('Queu/'.$ite->id) }}" class="cl" style="text-decoration: none; "> {{ $i}} {{$ite->role}}</a></td>
                            <td> <a href="{{ url('Queu/'.$ite->id) }}" class="cl" style="text-decoration: none; "> {{ $ite->prenom}}</a></td>
                            <td> <a href="{{ url('Queu/'.$ite->id) }}" class="cl" style="text-decoration: none; "> {{ $ite->nom }}</a></td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach

            </table>
            <input type="button" class="btnn2 solide" onclick="closepopupConsult2()" value="Annuler" style="background: red; color: white; margin-top: 20px; margin-left: 20px"/>
</div>
<script>
    let popupConsult2=document.getElementById('popupConsult2');

    function openpopupConsult2()
    {
      popupConsult2.classList.add("open-popupConsult2");
    }


    function closepopupConsult2(){
      popupConsult2.classList.remove("open-popupConsult2");
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
