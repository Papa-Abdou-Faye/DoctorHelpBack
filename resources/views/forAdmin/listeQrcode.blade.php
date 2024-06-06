@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')
<div class="divlistMedForAdmin2">
    <input type="submit" class="btnn3 solide" onclick="printpage()" value="IMPRIMER" style="background: rgb(21, 255, 0)">
</div>
<div class="pageMedCon" style="overflow: scroll; height: 85%;">
    <?php $i=0 ?>
    <?php $j=0 ?>
    
     <div id="d1" style="width: 80%; margin-left: 12%"> 
     <table class="table table-hover"; style="width: 100%">
            <tr>
                @foreach ($qrcodes as $item)
                    <?php $i++; ?>
                    <td>
                        <span style="margin-left: 5px">{{ QrCode:: generate($item->qrcodeContenu)}} </span>
                    </td>         
                        @if ($i % 5 == 0 && $i != 40 )
                            </tr> 
                            <tr>
                        @endif
                    @if ( $i % 40 == 0)
                        </tr>
                        <tr>
                            <td colspan="7" style=" text-align: center">
                                Les QRcodes du {{ $item->created_at }}
                            </td>
                        </tr>
                        <tr>
                  @endif
                @endforeach
            </tr>
     </table>
   </div>

    <script>
        function printpage(){
            
            let body = document.getElementById('body').innerHTML;
            let d = document.getElementById('d1').innerHTML;
            document.getElementById('body').innerHTML = d;
                // alert(d)
                    window.print();
            document.getElementById('body').innerHTML = body;
        }
    </script>
@endsection