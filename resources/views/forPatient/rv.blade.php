@extends("pere.mere")
@section("content")
@include("naveBarre.navBarPatient")
<div class="pageMedConDossier" style="background: rgb(240, 240, 240); width: 79%; margin-left: 15px; top: 13%">
    <div class="lien" style="background:white; left: 25px; height: 73%; width: 97%; position: relative; float: left; overflow: scroll;" >
       
        {{-- debut popup --}}
        {{-- fin popup --}}

        <table style="width: 100%; height: 200px; " class="table table-hover">
                <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900">
                    list RV 
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
              @foreach ($rv as $r)
              <tr>
                    <td style="padding: 10px; color:#13a3dc; width: 400px "> Rendez-vous du {{ $r->daterv }}</td>
                    <td style="padding: 10px; color:#13a3dc ">{{ $r->heurerv }}</td>
                    <td style="padding: 10px; color:#13a3dc ">{{ $r->note }}</td>
                    <td ><button type='submit' style='width: 50%; float:left; border-raduis:20%; ' class='createe_r'><i class='bx bx-trash'></i>annuler</button></td>
              </tr>
              @endforeach
        </table>
     
    </div>
@endsection