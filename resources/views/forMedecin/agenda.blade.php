@extends('pere.mere')
@section('content')
@include('naveBarre.navBarMedecin')
<div class="pageMedCon" style="overflow: scroll; height: 600px;">
    <table style="width: 100%; " class="table table-hover" >
        <div class="bk" style=" width: 100%;height: 40px; color: white; text-align: center; padding-top: 8px; font-weight: 600; font-size: 900">
            liste RV
        </div>
    {{-- <tr style="background: #13a3dc; width: 100%;height: 20px; color: white; text-align: center;">
            <td colspan="3">liste RV</td>
    </tr> --}}
    <tr>
        <td>Nom </td>
        <td>Prenom </td>
        <td>Date </td>
        <td>Heure</td>
        <td>Note de rv </td>
        <td>Annuler</td>
    </tr>
    @foreach ($agenda as $agenda)
              <tr>
                    <td > <a href="{{ url('consul/' .$agenda->user_id) }}" style="text-decoration: none; padding: 10px; color:#13a3dc; " >{{ $agenda->prenom }} </a></td>
                    <td > <a href="{{ url('consul/' .$agenda->user_id) }}" style="text-decoration: none; padding: 10px; color:#13a3dc; " >{{ $agenda->nom }} </a></td>
                    <td > <a href="{{ url('consul/' .$agenda->user_id) }}" style="text-decoration: none; padding: 10px; color:#13a3dc; " >{{ $agenda->daterv }} </a></td>
                    <td > <a href="{{ url('consul/' .$agenda->user_id) }}" style="text-decoration: none; padding: 10px; color:#13a3dc; " >{{ $agenda->heurerv }} </a></td>
                    <td > <a href="{{ url('consul/' .$agenda->user_id) }}" style="text-decoration: none; color:#13a3dc; " >{{ $agenda->note }} </a></td>
                    <?php
                        $aujourd8 = time();
                        $debut =new DateTime(date('y-m-d h:i:s', $aujourd8));
                        // Execution de code
                        // $fin = $agenda->created_at;
                        $fin = new DateTime($agenda->daterv);
                        $interval = $fin->diff($debut);
                        // echo $interval->format('Il s\'est écoulé  %R%S sec');
                        //-> Il s'est écoulé +02 sec
                        $jour = 1;
                    ?>
                    @if ($interval->format('%R%D%Y') < $jour)
                            <td ><button type='submit' style='width: 50%; float:left; border-raduis:20%; ' class='createe_r' style="height: 45px"><i class='bx bx-trash'></i>annuler</button></td>
                    @else
                            <td ><button type='submit' style='width: 50%; float:left; border-raduis:20%; background: greenyellow '  class='createe_r' style="height: 45px">passé</button></td>
                    @endif
              </tr>
              @endforeach
    </table>
</div>
@endsection
