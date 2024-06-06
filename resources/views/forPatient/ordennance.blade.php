@extends("pere.mere")
@section("content")
@include("naveBarre.navBarPatient")
<div class="pageMedConDossier" style="background: white; top: 13%">
    <div class="lien" style="background: rgb(240, 240, 240); left: 25px; height: 70%; width: 30%; position: relative; float: left;overflow: scroll; top: 10%" >

        {{-- debut popup --}}
        {{-- fin popup --}}
        <table style="" class="table table-hover" >
            <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900;">
                Ordennance par Date
            </div>
            @if(session('ord_first') == true)
              @foreach ($ordennances as $ordennance)
                <tr style=" width: 100%;height: 40px; color:#13a3dc; font-weight: 600; font-size: 900">
                    <td><a href="{{ url('voirOrdforPatient/' .$ordennance->id) }}">Ordennance du  {{ $ordennance->created_at }}</a></td>
                </tr>
              @endforeach
            @endif
        </table>
    </div>

    <div class="cons" style="background: none;margin-top: 15px; height: 76%; width: 60%; margin-left: 60px; position: relative; float: left; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
        <table>
            <tr>
                <td><img src="{{ asset('image/logoformulair.png') }}" class="logo logo--wut" style="width: 30%; float: left!important;margin-left: 15px; "></td>
                <td><span style="color: #13a3dc;font-style: italic">Doctor's Help</span><br><span style="float: right!important">Ordennance du  <br>@if(session('ord_first') == true) {{ $ord_med_date->created_at }} @endif</span></td>

            </tr>
            <tr>
                <td colspan="2"><img src="{{ asset('image/b.png') }}" class="logo logo--wut" style="height: 20px; width: 100%; left!important;"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; font-size: 900; font-weight: 500; text-decoration: underline 5px">ORDENNANCE</td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 10px " class="table table-hover">
            <tr  style="background: #13a3dc; color : white ;font-style: italic">
                <td>Medicaments</td>
                <td>Posologie</td>
                <td>Nbre Unite</td>
                <td>Quantite</td>
            </tr>
            @if(session('ord_first') == true)
                @foreach ($ord_medicaments as $medicam)
                <tr>
                    <td>{{$medicam->medicament}}</td>
                    <td>{{$medicam->posologie}} fois</td>
                    <td>{{$medicam->unite}} comprime(s)</td>
                    <td>{{$medicam->quantite}} tablette(s)</td>
                </tr>
                @endforeach
            @endif
        </table>

    </div>

</div>
@endsection
