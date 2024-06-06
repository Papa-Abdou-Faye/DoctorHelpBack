@extends('pere.mere')
@section('content')
@include('naveBarre.navBarCaisse')


<style>
  .popup{
      /* background:#13a3dc; */
      transform:translate(-50% -50px) scale(0.1);
      left:810px;
       /* margin-top: 145px; */
       Text-Align:center;
      place-items:center;
      width:30%;
      /* padding:0  10px 10px; */
      color:#333;
      visibility:hidden;
      transition:transform 0.4s,top 0.4s;
      position: relative;
      z-index: 70;
      height: 30px;
  }
  .open-popup{
      visibility:visible;
      /* position: center; */
      padding-top:10%;
      height: 300px;
      /* width: 400px; */
      transform:translate(-50% -50px) scale(1);
      z-index: 66;
      width:45%;
      position: fixed;

  }
  .popup1{
      /* background:#13a3dc; */
      transform:translate(-50% -50px) scale(0.1);
      left:66%;
       /* margin-top: 145px; */
       Text-Align:center;
      place-items:center;
      width:30%;
      /* padding:0  10px 10px; */
      color:#333;
      visibility:hidden;
      transition:transform 0.4s,top 0.4s;
      position: relative;
      z-index: 70;
      height: 30px;
  }
  .open-popup1{
      visibility:visible;
      /* position: center; */

      /* width: 400px; */
      transform:translate(-50% -50px) scale(1);
      z-index: 76;
      top: 220px;
      width:34%;

      height: 200px;
      overflow: scroll;
  }

  .popup2{
      /* background:#13a3dc; */
      transform:translate(-50% -50px) scale(0.1);
      left:50%;
       /* margin-top: 145px; */
      place-items:center;
      width:38%;
      /* padding:0  10px 10px; */
      color:#333;
      visibility:hidden;
      color: white;
      transition:transform 0.4s,top 0.4s;
      position: relative;
      z-index: 70;
      height: 30px;
  }
  .rv{
      background:#13a3dc;
    position: fixed;
      left: 280px;
      height: 390px;
      width: 42%;
      /* transform:translate(-30% -50px) scale(1); */
      bottom: 2%;
      z-index: 60;
      box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
  }

  .open-popup2{
      visibility:visible;
      /* position: center; */
      height: 250px;
      /* width: 400px; */
      transform:translate(-50% -50px) scale(1);
      z-index: 66;
      margin-left:15%;
      position: fixed;
      top: 15%;
  }
  .popupConsult{
        /* margin-top: 5px; */
        Text-Align:center;
        place-items:center;
        height: 100px;
        /* padding:0  10px 10px; */
        color:#333;
        visibility:hidden;
    }
    .open-popupConsult{
      visibility:visible;
        /* position: center; */
        left: 20%;
        width:80%;
        height: 70%;
        background: rgb(240, 240, 240);
        /* background: rgb(191, 190, 190); */
        position: fixed;
        z-index: 67;
        top: 15%;
    }
    /*
    ConultationForm */

    .input-field-insMed {
        width: 300px;
        height: 45px;
        background-color: white;
        margin-left: 25px;
        margin-top: 5px;
        border-radius: 55px;
        border: 1px outset gainsboro;
      float:right!important;
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
    .popupConsult1{
        /* margin-top: 5px; */
        Text-Align:center;
        place-items:center;
        height: 100px;
        /* padding:0  10px 10px; */
        color:#333;
        visibility:hidden;
    }
    .open-popupConsult1{
      visibility:visible;
        /* position: center; */
        left: 20%;
        width:80%;
        height: 70%;
        background: rgb(240, 240, 240);
        /* background: rgb(191, 190, 190); */
        position: fixed;
        z-index: 67;
        top: 15%;
    }
    .popupConsult2{
        /* margin-top: 5px; */
        Text-Align:center;
        place-items:center;

        /* padding:0  10px 10px; */
        height: 100px;
        color:#333;
        visibility:hidden;
    }
    .open-popupConsult2{
      visibility:visible;
        /* position: center; */
        left: 20%;
        width:80%;
        height: 70%;
        background: rgb(240, 240, 240);
        /* background: rgb(191, 190, 190); */
        position: fixed;
        z-index: 67;
        top: 15%;
    }
</style>
<div class="pageMedCon">
    <div class="infoMed" style= " width: 57%; margin-right: 30px; height: 150px; color: white; top : 10%">
        <table class="table " style="color: white;" >
            <tr>
                <td>
                <div  style="background:rgb(31, 212, 14); width:180px;float: left">

                    <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                        {{-- {{$nbrRV}} --}}
                    </span> <br>
                        <i class='bx bx-alarm icons' style="color: white ;font-size: 2.4rem;margin-left: 70px"></i> <br>
                        <span style="background: rgb(39, 163, 1); ">  Ticket &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ENG;</span>
                    </div>

                </td>
                <td>
                    <div  style="background:rgb(251, 255, 22); width:180px;float: left">

                        <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                            {{-- {{$nbrCON}} --}}
                        </span> <br>
                            <i class='bx bxs-star icons' style="color: rgb(52, 177, 3) ;font-size: 2.4rem; margin-left: 70px"></i> <br>

                            <span style="background: rgb(186, 199, 12); ">  Total &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; &ensp; &ENG;</span>
                        </div>

                    </td>
                <td>
                    <div  style="background:red; width:180px;float: left">

                        <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                            {{-- {{$k}} --}}
                        </span> <br>
                        <button onclick="openpopup1()" style="border:none; background: none">
                            <i class='bx bx-hourglass icons' style="color: white ;font-size: 2.4rem;margin-left: 70px"></i>
                        </button>
                            <br>

                            <span style="background: rgb(163, 12, 1); ">Patients &ensp;&ensp;&ensp; &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ENG;</span>
                        </div>
                </td>
                <td>
                    @if (session()->has('msgsec'))
                    <p class="alert alert-warning" style="text-align: center;" role="alert">
                        {{ session()->get('msgsec') }}
                    </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                <div  style="background:rgb(31, 212, 14); width:180px;float: left">

                    <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                        {{-- {{$nbrRV}} --}}
                    </span> <br>
                        <i class='bx bx-alarm icons' style="color: white ;font-size: 2.4rem;margin-left: 70px"></i> <br>
                        <span style="background: rgb(39, 163, 1); "> Dépense clinique &ensp;&ensp;&ensp;&ensp;&ensp;&ENG;</span>
                    </div>

                </td>
                <td>
                    <div  style="background:rgb(251, 255, 22); width:180px;float: left">

                        <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                            {{-- {{$nbrCON}} --}}
                        </span> <br>
                            <i class='bx bxs-star icons' style="color: rgb(52, 177, 3) ;font-size: 2.4rem; margin-left: 70px"></i> <br>

                            <span style="background: rgb(186, 199, 12); "> Dépense externe &ensp;&ensp;&ensp; &ensp; &ENG;</span>
                        </div>

                    </td>
                <td>
                    <div  style="background:red; width:180px;float: left">

                        <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                            {{-- {{$k}} --}}
                        </span> <br>
                        <button onclick="openpopup1()" style="border:none; background: none">
                            <i class='bx bx-hourglass icons' style="color: white ;font-size: 2.4rem;margin-left: 70px"></i>
                        </button>
                            <br>

                            <span style="background: rgb(163, 12, 1); ">reliquat &ensp;&ensp;&ensp; &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ENG;</span>
                        </div>
                </td>
                <td>
                    @if (session()->has('msgsec'))
                    <p class="alert alert-warning" style="text-align: center;" role="alert">
                        {{ session()->get('msgsec') }}
                    </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                <div  style="background:rgb(31, 212, 14); width:180px;float: left">
                    <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                        {{-- {{$nbrRV}} --}}
                    </span> <br>
                        <i class='bx bx-alarm icons' style="color: white ;font-size: 2.4rem;margin-left: 70px"></i> <br>
                        <span style="background: rgb(39, 163, 1); ">  Rendez-vous &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ENG;</span>
                    </div>
                </td>
                <td>
                    <div  style="background:rgb(251, 255, 22); width:180px;float: left">
                        <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                            {{-- {{$nbrCON}} --}}
                        </span> <br>
                            <i class='bx bxs-star icons' style="color: rgb(52, 177, 3) ;font-size: 2.4rem; margin-left: 70px"></i> <br>

                            <span style="background: rgb(186, 199, 12); ">  Consultation(s) &ensp;&ensp;&ensp;&ensp;&ensp; &ensp; &ENG;</span>
                        </div>
                    </td>
                <td>
                    <div  style="background:red; width:180px;float: left">

                        <span style="font-size: 28px; font-family: Roboto; font-weight: 900"> &ensp;
                            {{-- {{$k}} --}}
                        </span> <br>
                        <button onclick="openpopup1()" style="border:none; background: none">
                            <i class='bx bx-hourglass icons' style="color: white ;font-size: 2.4rem;margin-left: 70px"></i>
                        </button>
                            <br>

                            <span style="background: rgb(163, 12, 1); ">Patients &ensp;&ensp;&ensp; &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ENG;</span>
                        </div>
                </td>
                <td>
                    @if (session()->has('msgsec'))
                    <p class="alert alert-warning" style="text-align: center;" role="alert">
                        {{ session()->get('msgsec') }}
                    </p>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="calendar">
        <div class="calendar-header">
            <span class="month-picker" id="month-picker">Cub-Coding</span>
            <div class="year-picker">
                <span class="year-change" id="prev-year">
                    <pre><</pre>
                </span>
                <span id="year">2021</span>
                <span class="year-change" id="next-year">
                    <pre>></pre>
                </span>
            </div>
        </div>
        <div class="calendar-body">
            <div class="calendar-week-day">
                <div>Dim</div>
                <div>Lun</div>
                <div>Mar</div>
                <div>Mer</div>
                <div>Jeu</div>
                <div>Ven</div>
                <div>Sam</div>
            </div>
            <div class="calendar-days"></div>
        </div>
        <div class="calendar-footer">
            <div class="toggle">
                <span class="cl">Calendrier Doctor's help</span>
                <div class="dark-mode-switch">
                    <div class="dark-mode-switch-ident"></div>
                </div>
            </div>
        </div>
        <div class="month-list"></div>
        </div>
    </div>
</div>




    <div  id="popup" class="popup"  style="">
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card" style="background: #13a3dc; color: white">
                    <div class="card-header">{{ __('Chnager Mot de Passe') }}</div>

                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label">Ancien mot de passe</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Ancien mot de passe">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">Nouveau mot de passe</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="Nouveau mot de passe">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">Confirmation du mot de pass</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Confirmation du mot de pass">
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success" type="submit"  style="background: rgb(4, 252, 49); border: none">Enregistrer</button>
                            <button class="btn btn-success" type="button"  onclick="closepopup()" style="background: red; border: none">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div  id="popup2" class="popup2 bk" >
        <img src="{{ asset('image/profi.png') }}" class="imagepro">
        <table style="infoMed">
            <tr>
                <td>Prenom</td><td class="tdinf">{{ Auth::user()->prenom}} </td>
            </tr>
            <tr>
                <td>Nom</td><td class="tdinf">{{ Auth::user()->nom}}</td>
            </tr>
            <tr>
                <td>Adresse</td><td class="tdinf">{{ Auth::user()->adresse}}</td>
            </tr>
            <tr>
                <td >Qualite</td><td class="tdinf">{{ Auth::user()->role}}</td>
            </tr>
            <tr>
                <td >Email</td><td class="tdinf">{{ Auth::user()->email}}</td>
            </tr>
            <tr>
                <td >Telephone</td><td class="tdinf">+221 {{ Auth::user()->tel}}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-success" type="button"  onclick="closepopup2()" style="background: red; border: none; margin-left:50px">Fermer</button>
                </td>
            </tr>
        </table>
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

    let popup1=document.getElementById('popup1');

    function openpopup1()
    {
        popup1.classList.add("open-popup1");
    }

    function closepopup1(){
        popup1.classList.remove("open-popup1");
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
    let popupConsult1=document.getElementById('popupConsult1');

    function openpopupConsult1()
    {
      popupConsult1.classList.add("open-popupConsult1");
    }

    function closepopupConsult1(){
      popupConsult1.classList.remove("open-popupConsult1");
    }
</script>

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

@endsection
