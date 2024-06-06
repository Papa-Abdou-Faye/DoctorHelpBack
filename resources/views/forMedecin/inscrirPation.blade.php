@extends('pere.mere')
@section('content')
@include('naveBarre.navBarMedecin')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<style>
.popup{
    /* background:#13a3dc; */

    position: center;
    transform:translate(-50% -50px) scale(0.1);
    left:400px;
   margin-top: 145px;
     Text-Align:center;
    place-items:center;
    width:50%;

    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;
    transition:transform 0.4s,top 0.4s;

}
.open-popup{
    visibility:visible;
    /* position: center; */
    /* top:90%;  */
    height: 460px;
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 46;
}


</style>
{{-- <div class="pageMedCon"> --}}
<table class="form-container-insMed">
    <form action="{{ route('insPatient') }}" method="post" class="formIns med" id="form">
        @csrf
        <fieldset><legend>iNSCRIRE PATIENT</legend>
            <tr>
                <div class="popup" id="popup">
                    <div class="card bg-white shadow rounded-3 p-3 border-0" style="width: 400px; left: 150px; top:50px">
                        <input type="button" class="textinsMed solide" value="ATTRIBUTION DE CARTE">
                        <div class="wrapper">
                            <div class="scanner"></div>
                            <video id="preview"></video>
                        </div>
                      <input type="hidden" name="cartePatient"  id="cartePatient">
                        <input type="button" class="btnn2 solide" onclick="closepopup()" value="IGNORER" style="background: red; color:white; margin-left: 30%">
                    </div>
                </div>
                <td colspan="2" style="padding-left: 29%;padding-top: 5px;">
                    <input type="button" class="textinsMed solide" value="iNSCRIPTION PATIENT">
                </td></tr><tr>
                <td colspan="2" style="padding: 0%">
                    @if ($errors->any())
                            <div class="alert alert-danger" style="text-align: center; float: right!important;">
                                @foreach ($errors->all() as $error)
                                  {{ $error }};
                                @endforeach
                            </div>
                    @endif
                </td>
            </tr>
            @if (session()->has('msg'))
            <tr>
                <td colspan="2">
                <p class="alert alert-warning" style="text-align: center" role="alert">
                    {{ session()->get('msg') }}
                </p>
                </td>
            </tr>
            @endif
            <tr>
                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bxs-user'></i>
                            <input type="text" placeholder="Prenom" name="prenom" class=" @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                        <i class='bx bxs-user'></i>
                        <input type="text" placeholder="Nom" name="nom" class=" @error('nom') is-invalid @enderror"  value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                        </div>
                    </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bx-home'></i>
                        <input type="text" placeholder="Adresse" name="adresse" class=" @error('adresse') is-invalid @enderror"  value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                        <i class='bx bx-calendar'></i>
                    <input type="date" placeholder="Date de naissance" name="date_nai" class=" @error('date_nai') is-invalid @enderror" value="{{ old('date_nai') }}" required autocomplete="date_nai" autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bx-female-sign'></i>
                        <select name="sexe" class=" @error('sexe') is-invalid @enderror" value="{{ old('sexe') }}" required autocomplete="sexe" autofocus style="border: none">
                            <option>Femme</option>
                            <option>Homme</option>
                        </select>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                        <i class='bx bx-group'></i>
                        <select name="statut" class=" @error('statut') is-invalid @enderror" value="{{ old('statut') }}" required autocomplete="statut" autofocus style="border: none">
                            <option>Marié</option>
                            <option>celibataire</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bx-envelope'></i>
                        <input type="text" placeholder="Email" name="email" class=" @error('email') is-invalid @enderror" value="{{ old('email') }}"  autocomplete="email" autofocus>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                        <i class='bx bxs-phone-incoming'></i>
                    +221<input type="number" placeholder="Telephone" name="tel" class=" @error('tel') is-invalid @enderror" value="{{ old('tel') }}"  autocomplete="tel" autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bxl-postgresql'></i>
                        <input type="text" value="PATIENT" name="role" readonly>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                    <i class='bx bxs-shopping-bag'></i>
                    <input type="text" placeholder="profession" name="profession" class=" @error('profession') is-invalid @enderror" value="{{ old('profession') }}"  autocomplete="profession" autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bxs-droplet'></i>
                        <select name="sang" class=" @error('sang') is-invalid @enderror" value="{{ old('sang') }}"  autocomplete="sang" autofocus style="border: none">
                            <option> </option>
                            <option>A+</option>
                            <option>A-</option>
                            <option>B+</option>
                            <option>B-</option>
                            <option>AB</option>
                            <option>O+</option>
                            <option>O-</option>
                        </select>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                     <i class='bx bxs-quote-alt-left'></i>
                    <input type="text" placeholder="allergies" name="allergie" class=" @error('allergie') is-invalid @enderror" name="allergie" value="{{ old('allergie') }}" autocomplete="allergie" autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bxs-user'></i>
                        <input type="text" placeholder=" CNI ou EXTRAIT" name="CNI" class=" @error('CNI') is-invalid @enderror" name="CNI" value="{{ old('CNI') }}"  autocomplete="CNI" autofocus>
                    </div>
                </td>

                <td>
                    <div class="input-field-insMed">
                    <i class='bx bx-phone-call' ></i>
                    +221<input type="number" placeholder="tel-personne a prevenir" name="tel_a_prevenir" class=" @error('tel_a_prevenir') is-invalid @enderror" name="tel_a_prevenir" value="{{ old('tel_a_prevenir') }}"  autocomplete="tel_a_prevenir" autofocus>
                    </div>
                </td>
            </tr>
            <tr>

                <td colspan="2" style="padding-left: 40%">
        <input type="hidden" placeholder="passs" name="password" value="1234" >
        <input type="hidden" placeholder="passs" name="password_confirmation" value="1234" >
        </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-left: 30%">
                    <input type="submit" class="btnn2 solide"  value="Enregistrer">
                    <input type="button" class="btnn2 solide" onclick="openpopup()" value="CARTE" style="margin-left: 30px">
            </td>
        </tr>
            <tr>

                <td colspan="2" style="">
                    <input type="hidden" placeholder="passs" name="password" value="1234" >
                    <input type="hidden" placeholder="passs" name="password_confirmation" value="1234" >
                </td>
         </tr>
        </fieldset>
    </form>

</table>
{{-- </div> --}}

{{--
@if ($errors->any())
<div class="alert alert-danger" style="text-align: center; float: right!important;">
<ul>
 @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    <script type="text/javascript">alert($error);</script>
@endforeach

</ul>
</div>
@endif
 --}}

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
