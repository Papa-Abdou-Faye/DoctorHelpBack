@extends('pere.mere')
@section('content')
@include('naveBarre.navBarMedecin')
<div class="pageMedCon">
    <div  style="overflow: scroll; height: 100%;">
        <table class="table table-striped">
            <thead class="en-tete" >
              <tr style="color: white">
                <th scope="col" >Image</th>
                <th scope="col">Pathologie</th>
                <th scope="col">Description</th>
                <th scope="col">Traitement</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody style="font-size: 18px; font-family: 'Times New Roman'">
                @foreach ($pathos as $p )
                <tr >
                  <th scope="row"><img src="{{ asset('image/maladie.png') }}" style="width: 30px"> </th>
                  <td> {{ $p->nom }}</td>
                  <td>{{Str::limit($p->desc, 20) }}</td>
                  <td>{{ Str::limit($p->traitements, 20) }}</td>
                  <td style="text-align: center; width: 190px">
                    <button data-toggle="collapse" data-target="#col{{ $p->id }}" class="createe"  style="height: 35px" >
                        {{-- <i class="fa fa-pencil"></i> --}}
                        <i class='bx bx-show-alt' style="width: 40%;"></i>voir
                      </button>
                  </td>
                </tr>
                <tr style="margin: 0; padding: 0; color: white; " class="bk" >
                    <td colspan="8" style="margin: 0; padding: 0 " >
                      <div class="collapse" id="col{{ $p->id }}" style="padding: 0px; margin: 0px;">
                          <table style=" width: 100%">
                              <tr>
                                  <td><img src="{{ asset('image/maladie.png') }}" style="width: 30px"></td>
                                  <td>{{ $p->nom }} </td>
                                  <td style="width: 500px">{{$p->desc, 20}}  </td>
                                  <td style="width: 400px">{{ $p->traitements, 20}} </td>
                              </tr>
                          </table>
                      </div>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</div>
@endsection
