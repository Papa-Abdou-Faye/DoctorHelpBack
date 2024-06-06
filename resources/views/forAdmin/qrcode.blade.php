
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')
<div class="pageMedCon">
    
    @if (session()->has('succes'))
        
    {{-- <div class="alert alert-warning" role="alert">
        {{ session()->has('gagal') }}
    </div> --}}
    <p class="alert alert-warning" role="alert">
      {{ session()->get('succes') }}
    </p>
    {{-- <script>
      alert('ce code est dej')
    </script> --}}
  @endif
    <form action="{{ route('qrcode_generer.admin') }}" method="POST" style="width: 100%; margin-top : 90px">
        {{-- pour des mesures de securite de lara vel on ajoute @csrf --}}
        @csrf
        <input type="submit" class="btnn-generer solide" value="Generer des QRcodes">
    </form>
    <img src="{{ asset('image/c bleu.jpg') }}" style="margin-top: 70px; margin-left: 50px" ><img src="{{ asset('image/c rouge.jpg') }}" style="margin-top: 70px">
</div>

{{-- {{ QrCode:: generate('je suis mouride, dieureuf serigne Abdou') }}  --}}
@endsection