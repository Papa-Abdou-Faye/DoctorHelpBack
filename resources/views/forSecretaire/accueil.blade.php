
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarSecretaire')

<style>
  .popup{
      /* background:#13a3dc; */
      transform:translate(-50% -50px) scale(0.1);
      left:13%;
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
      z-index: 76;
      width:44%;
      position: fixed;

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
<div class="pageMedCon">
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

<div  id="popup" class="popup">
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


    <div  class="rv" >
        <div class="bk" style=" overflow: scroll;width: 100%; height: 100%; ">
            {{-- <span class="alert alert-warning" role="alert" > {{ session()->get('rvDuJour') }}</span> --}}
            <table style="width: 150%" class="table table-hover">
                <div class="cl" style="background: white; width: 150%;  text-align: center; font-weight: 600; font-size: 900;">
                    Liste des rendez-vous du  {{$daterv}}
                </div>
                {{-- <tr style="background: #13a3dc; width: 100%;height: 20px; color: white; text-align: center;">
                        <td colspan="3">liste RV</td>
                </tr> --}}
                <tr style="color: white">
                    <td>Prenom </td>
                    <td>Nom </td>
                    <td>Heure</td>
                    <td>Traitant</td>
                    <td>Action </td>
                </tr>
                <?php $aujour = date('d-m-Y') ?>
                <?php $k = 0; ?>
                @foreach ($rv as $r)
                    <tr style="color: white">
                            <td>{{ $rvs2[$k]->prenom }} </td>
                            <td>{{ $rvs2[$k]->nom }} </td>
                            <td> {{ $r->heurerv }}</a></td>
                            <td>Dr. {{ $r->nom }} </a></td>
                            <td>
                                <?php
                                    $aujourd8 = time();
                                    $debut =new DateTime(date('y-m-d h:i:s', $aujourd8));
                                    // Execution de code
                                    // $fin = $agenda->created_at;
                                    $fin = new DateTime($daterv);
                                    $interval = $fin->diff($debut);
                                    // echo $interval->format('Il s\'est écoulé  %R%S sec');
                                    //-> Il s'est écoulé +02 sec
                                    $jour = 1;
                                ?>
                                @if ($interval->format('%R%D%Y') < $jour)
                                    <a href="{{ url('alert/'.$rvs2[$k]->user_id) }}" style="text-decoration: none; color:#13a3dc; " >
                                        <button type="submit"  style="height: 35px; background: greenyellow ; border:none; color:white"><i class='bx bx-command' style="width: 20px"></i>msg</button>
                                    </a>
                                    <a href="{{ url('rpt/'.$rvs2[$k]->user_id) }}" style="text-decoration: none; color:#13a3dc; " >
                                        <button type="submit" style="height: 35px; background: rgb(250, 230, 50); border:none; color:white" ><i class='bx bx-command' style="width: 20px"></i>RPT</button>
                                    </a>
                                    <a href="{{ url('supRv/'.$r->id) }}">
                                        <button type="submit" style="height: 35px; background: red; border:none; color:white" ><i class='bx bx-command' style="width: 20px"></i>Ann</button>
                                    </a>
                                @endif
                                @if ( $daterv == $aujour )
                                    <button type="submit" style="height: 35px; background: rgb(0, 0, 0); border:none; color:white" ><i class='bx bx-command' style="width: 20px"></i>Raté</button>
                                    <button type="submit" style="height: 35px; background: rgb(20, 245, 207); border:none; color:white" ><i class='bx bx-command' style="width: 20px"></i>Passé</button>
                                @endif
                            </td>
                    </tr>
                    <?php $k++; ?>
                @endforeach
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

