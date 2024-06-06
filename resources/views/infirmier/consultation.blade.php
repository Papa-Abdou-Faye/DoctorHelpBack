@extends('pere.mere')
@section('content')
@include('naveBarre.navBarInf')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<div class="pageMedCon">
  &ensp;&ensp;&ensp;&ensp;&ensp;<img src="{{ asset('image/c bleu.jpg') }}" style="width: 500px; height: 200px;" ><img src="{{ asset('image/c rouge.jpg') }}" style="width: 500px; height: 200px;">
  <div class="card bg-white shadow rounded-3 p-3 border-0" style="width: 400px; left: 350px; top:10px">

      @if (session()->has('non-trouve'))
        <span class="alert alert-warning" role="alert" style="height: 2px; margin-top: 0%"> {{ session()->get('non-trouve') }}</span>
      @endif
    <div class="wrapper">
        <div class="scanner"></div>
        <video id="preview"></video>
    </div>
      <form action="{{ route('inf_consulter.med') }}" method="POST" id="form">
        @csrf
        <input type="hidden" name="qrcode" id="qrcode">
      </form>
  </div>
  <div style="margin-top: 15px; margin-right: 100px;">
    <form action="{{ route('inf_consultercni.med') }}" method="POST">
      @csrf
      <span class="bartitreSearch">
        <i class='bx bx-search-alt-2 icons'></i>
        <input type="search" placeholder="Chercher CNI ou Numero Extrait ..." name="CNI"><input type="submit" value="Valider" style="width: 100px; border: 2px outset gainsboro">
    </span>
    </form>
  </div>
</div>


  <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
      scanner.addListener('scan', function(c){
        document.getElementById('qrcode').value = c;
        document.getElementById('form').submit();
      })
    </script>
@endsection








{{-- <script src="html5-qrcode.min.js"></script> --}}


{{--
    <div class="row">
      <div class="col">
        <div style="width:500px;" id="reader"></div>
      </div>
      <div class="col" style="padding:30px;">
        <h4>SCAN RESULT</h4>
        <div id="result">Result Here</div>
      </div>
    </div>


    <script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
        document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
    }

    function onScanError(errorMessage) {
      //handle scan error
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);

    </script>
     --}}




 {{-- <script src="https://cdn.jsdelivr.net/npm/dynamsoft-javascript-barcode@9.0.0/dist/dbr.js"></script>
        <script src="https://reeteshghimire.com.np/wp-content/uploads/2021/05/html5-qrcode.min_.js"></script>
        <style>
            .result{
              background-color: green;
              color:#fff;
              padding:20px;
            }
            .row{
              display:flex;
            }
          </style> --}}
          {{-- <script src="https://rawgt.com/schmich/instasacn-builds/master/instascan.min.js"></script> --}}
          {{-- <script type="text/javascript" src="{{ asset('build/assets/instascan.min.js') }}"></script> --}}
