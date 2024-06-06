<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>admin.php</h1>
    @foreach ($adm as $item)
        <h3><a href="{{ route('transfertVar.show', ['varId'=> $item->id]) }}">{{ $item }}</a></h3>
    @endforeach
    <h1>affichons seulement les login</h1>
    @foreach ($adm as $item)
        <h3><a href="#">{{ $item->login }}</a></h3>
    @endforeach
    <h1>affichons seulement les login si le nombre de login est superieur a 100</h1>
    @if ($adm->count()>100)
        @foreach ($adm as $item )
            <h3><a href="#">{{ $item->login }}</a></h3>
        @endforeach
    @else
        vous n'avez pas encor 100 login.
    @endif


   

</body>
</html>





<div class="tableMed" style="height: 500px;overflow: scroll;">
    <table class="table table-striped table-hover" >
        <thead class="en-tete" >
          <tr>
            <th scope="col" style="color: white">Image</th>
            <th scope="col" style="color: white">Prenom</th>
            <th scope="col" style="color: white">Nom</th>
            <th scope="col" style="color: white">Sang</th>
            <th scope="col" style="color: white">Sexe</th>
            <th scope="col" style="color: white">Email</th>
            <th scope="col" style="color: white">Action</th>
          </tr>
        </thead>
        <tbody style="font-size: 18px; font-family: 'Times New Roman'">
          @foreach ($patient as $p )
            <tr >
                <th scope="row"><img src="{{ asset('image/im2.png') }}" style="width: 30px"> </th>
                <td>{{ $p->prenom}}</td>
                <td>{{ $p->nom}}</td>
                <td>{{ $p->sang}}</td>
                <td>{{ $p->sexe}}</td>
                <td>{{ $p->email}}</td>
                <td >
                    {{-- <a href="#" id="toggle-table"><button class="createe"><i class='bx bx-show-alt' style="width: 40%"></i>voir</button></a> --}}
                    <button class="createe" style="position: relative; cursor: pointer;"><i class='bx bx-show-alt' style="width: 40%"></i>voir</button>
                    <a href="" title="modifier medicament"> <button class="createe"><i class='bx bxs-edit' style="width: 40%"></i>edit</button></a>
                    <a href="{{ url('supUser/' .$p->id) }}"><button type="submit" class="createe_r" title="supprimer medicament" onclick="return confirm('Confirm ?')"><i class='bx bx-trash' style="width: 40%"></i>sup</button> </a>
                </td>
            </tr>
            {{-- <tr id="my-table"  style="display: none; margin: auto"> --}}
              <div style=" position: relative; background: #13a3dc; color: white; height: 0;  transition: 0.5s; overflow-y: auto; padding: 0; margin: 0">
                       1 
                      {{ $p->prenom}}
                      {{ $p->nom}}
                      {{ $p->sang}}
                      {{ $p->sexe}}
                      {{ $p->email}}
                      <a href="{{ url('consul/' .$p->id) }}"><button class="createe"><i class='bx bx-show-alt' style="width: 40%"></i>voir</button></a>      
            </div>
            @endforeach
        </tbody>
      </table>
</div>