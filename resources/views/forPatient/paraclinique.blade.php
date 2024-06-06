@extends("pere.mere")
@section("content")
@include("naveBarre.navBarPatient")

<div class="pageMedConDossier" style="background: white; top: 13%">
    <div class="lien" style="background: rgb(240, 240, 240); left: 25px; height: 70%; width: 30%; position: relative; float: left;overflow: scroll;" >

            {{-- debut popup --}}
            {{-- fin popup --}}
            <table style="" class="table table-hover" >
                <div style="background: #13a3dc; width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900;">
                    Paraclinique par Date
                </div>
                @if(session('para_first') == true)
                  @foreach ($paracliniques as $para)
                    <tr style=" width: 100%;height: 40px; color:#13a3dc; font-weight: 600; font-size: 900">
                        <td><a href="{{ url('voirparaforPatient/'.$para->id) }}">Paraclinique du  {{ $para->created_at }}</a></td>
                    </tr>
                  @endforeach
                @endif
            </table>
            <input  type="button" class="textinsMed solide" onclick="openpopupConsult()" value="enregistrer paraclinique" style="background: #13a3dc; border-radius: 1px; height: 40px; color: white; bottom: 9%; position: fixed ; width: 24%">
    </div>

    <div class="cons" style="background: none; margin-top: 15px; height: 60%; width: 60%; margin-left: 60px; position: relative; float: left; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;" id="div1">
            <table class="table table-hover" style="width: 100%"><?php $aujourdhui = date("Y-m-d"); ?>
                @if(session('para_first') == true)
                        <tr>
                            <td colspan="4" style="text-align: center">
                                <input type="button" class="textinsMed solide" value="Paraclinique">
                            </td>
                        </tr>
                        <tr>
                            <td><span>Prenom : </span></td><td> <span> {{Auth::user()->prenom}} </span></td>
                            <td><span>Nom : </span></td><td> <span> {{Auth::user()->nom}} </span></td>
                        </tr>
                        <tr>
                            <td><span>Sexe : </span></td><td> <span> {{Auth::user()->sexe}} </span></td>
                            <td><span>Age : </span></td><td> <span> {{ date_diff(date_create(Auth::user()->date_nai), date_create($aujourdhui))->format('%y').' ans' }} </span></td>
                        </tr>
                        <tr>
                            <td><span>Adresse : </span></td><td> <span> {{Auth::user()->adresse}} </span></td>
                            <td><span>Telephone : </span></td><td> <span> {{Auth::user()->tel}} </span></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center; color: #13a3dc">Exemen demande(s)</td>
                        </tr>
                        <tr>
                            <td colspan="4" ><button class="btnn2 solide" style=" float: leftt!important; height: 59px; width: 200px ;background: none; color: #aaa"> {{$paraclinique->exam}}</button></td>
                        </tr>
                        {{-- <tr>
                            <td colspan="4" > <span style="color: #13a3dc; float: right!important;"> Dr {{Auth::user()->nom}}, paraclinique du {{$paraclinique->created_at}} </span></td>
                        </tr> --}}
                @endif
            </table>

            <button onclick="printpage()" class="btnn2 solide" style="bottom: 0; position: absolute; float: right!important;">Imprimer</button>
    </div>
</div>



@endsection
