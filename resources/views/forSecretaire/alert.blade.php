
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarSecretaire')

<style>
  .popup{
      /* background:#13a3dc; */
      transform:translate(-50% -50px) scale(0.1);
      left:815px;
       /* margin-top: 145px; */
       Text-Align:center;
      place-items:center;
      width:45%;
      /* padding:0  10px 10px; */
      color:#333;
      visibility:hidden;
      transition:transform 0.4s,top 0.4s;
  }
  .popup2{
      /* background:#13a3dc; */
      transform:translate(-50% -50px) scale(0.1);
      left:835px;
       /* margin-top: 145px; */
      place-items:center;
      width:38%;
      /* padding:0  10px 10px; */
      color:#333;
      visibility:hidden;
      color: white;
      transition:transform 0.4s,top 0.4s;
  }
  .rv{
      background:#13a3dc;
      position: fixed;
      left: 680px;
      height: 550px;
      width: 49%;
      /* transform:translate(-30% -50px) scale(1); */
      bottom: 2%;
      z-index: 60;
      box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
  }
  .open-popup{
      visibility:visible;
      /* position: center; */
      padding-top:10%;
      height: 300px;
      /* width: 400px; */
      transform:translate(-50% -50px) scale(1);
      z-index: 66;
      position: fixed;

  }
  .open-popup2{
      visibility:visible;
      /* position: center; */
      height: 200px;
      /* width: 400px; */
      transform:translate(-50% -50px) scale(1);
      z-index: 66;
      position: fixed;
      top: 13%;
  }

</style>
<div  id="popup" class="popup"  style=" z-index : 51;">
  <div class="row justify-content-center" >
      <div class="col-md-8">
          <div class="bk" >
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


<div class="pageMedConDossier" style="background: white; top:15%">
    <div class="lien" style="background: rgb(240, 240, 240); left: 10px; top: 10px; height: 75%; width: 30%; position: relative; float: left;" >

        <img src="{{ asset('image/secr.jpg') }}" class="logo logo--wut" style="width: 115%; height: 110%;">
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
                            <span>RAPPEL DE RENDEZ-VOUS</span>
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
                    <form action="{{ route('persoAlertSms') }}" method="post">
                        @csrf
                    <tr>
                        <td colspan="4" class="cl" style="text-align: center;"> <textarea name="msg" required style="width: 600px; height: 100px;margin-top: 20px; border: none; background-color: #b3b4b4; color: white"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="cl" style="text-align: center; "><input type="submit" class="btnn2 solide" value="Envoyer" style="height: 40px; width: 150px; border-radius: 0px; background: rgb(18, 155, 29);" required > </form> <a href="{{route('envAlert')}}"><input type="submit" class="btnn2 solide" value="Alerter" style=" margin-left: 10px;height: 40px; width: 150px; border-radius: 0px; background: rgb(226, 188, 18)"></a><a href="{{route('acc.sec')}}"><input type="submit" class="btnn2 solide" value="Annuler" style=" margin-left: 10px;height: 40px; width: 150px; border-radius: 0px; background: rgb(250, 17, 9)"></a></td>
                    </tr>

        </table>
    </div>
</div>

    <div  id="popup2" class="popup2 bk" >
        <img src="{{ asset('image/profi.png') }}" class="imagepro">
        <table style="infoMed">
            <tr>
                <td>Prenom</td><td class="tdinf">{{ Auth::user()->prenom}}</td>
            </tr>
            <tr>
                <td>Nom</td><td class="tdinf">{{ Auth::user()->nom}}</td>
            </tr>
            <tr>
                <td>Adresse</td><td class="tdinf">{{ Auth::user()->adresse}}</td>
            </tr>
            <tr>
                <td >Qualite</td><td class="tdinf">Medecin</td>
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

