@extends("pere.mere")
@section("content")
@include("naveBarre.navBarPatient")
<style>
.popup{
    
    position: center;
    transform:translate(-50% -50px) scale(0.1);
    left:350px;
    Text-Align:center;  
    place-items:center;
    width:50%;
    color:#333; 
    visibility:hidden; 
    transition:transform 0.4s,top 0.4s;
}
    
.open-popup{
    visibility:visible;
    padding-top:10%; 
    height: 300px;
    transform:translate(-50% -50px) scale(1);
    position: relative;
    z-index: 46;
}
</style>    
<table class="form-container-insMed">
    <form  class="formIns med" id="form">
            <tr>
                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bxs-user'></i> Prenom : 
                            <span style="font-size: 800; font-weight: 700">{{ $user->prenom }}</span>
                        </div>
                    </td>
                    
                    <td>
                        <div class="input-field-insMed">
                        <i class='bx bxs-user'></i>
                            Nom : <span style="font-size: 800; font-weight: 700">{{ $user->nom }}</span>
                        </div>
                    </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bx-home'></i>
                        Adresse : <span style="font-size: 800; font-weight: 700">{{ $user->adresse }}</span>
                    </div>
                </td>
                
                <td>
                    <div class="input-field-insMed">
                        <i class='bx bx-calendar'></i>
                        Date de Naisssance : <span style="font-size: 800; font-weight: 700">{{ $user->date_nai }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bx-female-sign'></i>
                        Sexe : <span style="font-size: 800; font-weight: 700">{{ $user->sexe }}</span>
                    </div>
                </td>
                
                <td>
                    <div class="input-field-insMed">
                        <i class='bx bx-group'></i>
                        Statut :<span style="font-size: 800; font-weight: 700">{{ $user->statut }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bx-envelope'></i>
                        Email : <span style="font-size: 800; font-weight: 700">{{ $user->email }}</span>
                    </div>
                </td>
                
                <td>
                    <div class="input-field-insMed">
                        <i class='bx bxs-phone-incoming'></i>
                        Telephone : <span style="font-size: 800; font-weight: 700">{{ $user->tel }}</span>
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
                    Profession : <span style="font-size: 800; font-weight: 700">{{ $user->profession }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bxs-droplet'></i>
                        Groupe Sanguin : <span style="font-size: 800; font-weight: 700">{{ $user->sang }}</span>
                    </div>
                </td>
                
                <td>
                    <div class="input-field-insMed">
                     <i class='bx bxs-quote-alt-left'></i>
                     Allergie : <span style="font-size: 800; font-weight: 700">{{ $user->allergie }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td >
                    <div class="input-field-insMed">
                        <i class='bx bxs-user'></i>
                        CNI : <span style="font-size: 800; font-weight: 700">{{ $user->CNI }}</span>
                    </div>
                </td>
                
                <td>
                    <div class="input-field-insMed">
                    <i class='bx bx-phone-call' ></i>
                    A prevenir : <span style="font-size: 800; font-weight: 700">{{ $user->tel_a_prevenir }}</span>
                    </div>
                </td>
            </tr>
       
        </fieldset>
    </form>
    
</table>
<div  id="popup" class="popup"  style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
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
@endsection