@extends("pere.mere")
@section("content")
@include("naveBarre.navBarPatient")

<div class="pageMedConDossier" style="background: white; top: 13%;">
    <div class="lien" style="background: rgb(240, 240, 240); left: 25px; height: 66%; width: 30%; position: relative; float: left; overflow: scroll; top: 10%;" >
        <table style="" class="table table-hover" >
            <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900;">
                consultations par Date
            </div>
              {{-- <tr style="background: #13a3dc; width: 100%; color: white; text-align: center;">
                    <td>consultations par Date</td>
              </tr> --}}
              {{-- <form action="{{ route('voirCons') }}" method="post"> --}}

              @foreach ($consultations as $consultation)
                <tr style=" width: 100%;height: 40px; color:#13a3dc; font-weight: 600; font-size: 900">
                    <td><a href="{{ url('voirConsforPatient/' .$consultation->id) }}">consultation du  {{ $consultation->created_at }}</a></td>
                </tr>
              @endforeach
            {{-- </form> --}}
        </table>

    </div>

    <div class="cons" style="background: none; height: 76%; width: 60%; position: relative; float: left; left: 100px; margin-top: 20px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;overflow: scroll;">
        <table class="table table-hover">
                {{-- @foreach ($consul as $consul) --}}
            @if (session('consultation_trouve')==true)

                <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 700; font-size: 1500">
                    consultations du {{ $consul->created_at }}
                </div>
                <tr>
                    <td>Motifs</td>
                    <td>{{ $consul->motif }} </td>
                </tr>
                <tr>
                    <td>Temperature</td>
                    <td>{{ $consul->temperature }} °c</td>
                </tr>
                <tr>
                    <td>Taille</td>
                    <td>{{ $consul->taille }} cm</td>
                </tr>
                <tr>
                    <td>Poids</td>
                    <td>{{ $consul->poids }} kg</td>
                </tr>
                <tr>
                    <td>IMC</td>
                    <td>{{ $consul->IMC }} kg/cm</td>
                </tr>
                <tr>
                    <td>Pression Arterielle</td>
                    <td>{{ $consul->pression }}</td>
                </tr>
                <tr>
                    <td>Frequence Cardiaque</td>
                    <td>{{ $consul->frequence }}</td>
                </tr>
                <tr>
                    <td>Tension</td>
                    <td>{{ $consul->tension }}</td>
                </tr>
                <tr >
                    <td colspan="2" style="text-align: center">Note Diognostique</td>
                </tr>
                <tr >
                    <td colspan="2" style="text-align: center; height: 50px;">{{ $consul->note }}</td>
                </tr>
            @endif
            @if(session('consultation_trouve') == false)
                @foreach ($consul as $consul)
                    <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 700; font-size: 1500">
                        consultations du {{ $consul->created_at }}
                    </div>
                    <tr>
                        <td>Motifs</td>
                        <td>{{ $consul->motif }}</td>
                    </tr>
                    <tr>
                        <td>Temperature</td>
                        <td>{{ $consul->temperature }}</td>
                    </tr>
                    <tr>
                        <td>Taille</td>
                        <td>{{ $consul->taille }}</td>
                    </tr>
                    <tr>
                        <td>Poids</td>
                        <td>{{ $consul->poids }}</td>
                    </tr>
                    <tr>
                        <td>IMC</td>
                        <td>{{ $consul->IMC }}</td>
                    </tr>
                    <tr>
                        <td>Pression Arterielle</td>
                        <td>{{ $consul->pression }}</td>
                    </tr>
                    <tr>
                        <td>Frequence Cardiaque</td>
                        <td>{{ $consul->frequence }}</td>
                    </tr>
                    <tr>
                        <td>Tension</td>
                        <td>{{ $consul->tension }}</td>
                    </tr>
                    <tr >
                        <td colspan="2" style="text-align: center">Note Diognostique</td>
                    </tr>
                    <div style="height: 50px;">{{ $consul->note }}</div>
                @endforeach
            @endif
        </table>
    </div>
</div>
@endsection
