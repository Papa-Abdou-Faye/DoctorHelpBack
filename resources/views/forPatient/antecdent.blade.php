@extends("pere.mere")
@section("content")
@include("naveBarre.navBarPatient")
<div class="pageMedConDossier" style="background: rgb(240, 240, 240); width: 79%; margin-left: 15px; top: 13% ">
    <div class="lien" style="background:white; left: 25px; height: 73%; width: 97%; position: relative; float: left; overflow: scroll;" >
       
        {{-- debut popup --}}
        {{-- fin popup --}}
        <table style="width: 100%; height: 200px; " class="table table-hover">
            <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900">
                liste Antecedent
            </div>
              {{-- <tr style="background: #13a3dc; width: 100%; height: 15px; color: white; text-align: center;">
                    <td colspan="4">liste Antecedent</td>
              </tr> --}}
              <tr>
                <td>Pathologie</td>
                <td>Famille</td>
                <td>Date de debut </td>
                <td>Date de fin </td>
              </tr>
              @foreach ($antecedents as $antecedent)
              <tr>
                    <td style="padding: 10px; color:#13a3dc; width: 400px "> {{ $antecedent->pathologie }}</td>
                    <td style="padding: 10px; color:#13a3dc ">{{ $antecedent->famille }}</td>
                    <td style="padding: 10px; color:#13a3dc ">{{ $antecedent->datedebut }}</td>
                    <td style="padding: 10px; color:#13a3dc ">{{ $antecedent->datefin }}</td>
              </tr>
              @endforeach
        </table>
    </div>
@endsection