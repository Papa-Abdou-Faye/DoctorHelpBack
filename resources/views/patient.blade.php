{{--
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarPatient')
@endsection


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup</title>
    <style>
*{
    margin:8;
    padding:8;
    box-sizing:border-box;
    font-family: 'Poppins',sans-serif;
}
.container{
    width:100%;
    height:100vh;
 background:#87CEEB;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-top:0px;
}
.btn{
    padding:10px 60px;
    background:#87CEEB;
    border:0;
    outline:none;
    cursor:pointer;
    font-size:22px;
    font-weight:500;
    border-radius:30px;
}
.popup{
    background:#fff;
    border-radius:6px;
    position: absolute;
    transform:translate(-50% -50px) scale(0.1);
    /* left:0; */
   top:50;
     /* Text-Align:center;   */
    place-items:center;
    width:50%;

    /* padding:0  10px 10px; */
    color:#333;
    visibility:hidden;
    transition:transform 0.4s,top 0.4s;
}
.open-popup{
    visibility:visible;
    top:50;
    transform:translate(-50% -50px) scale(1);
}
.popup img{

    width:35%;
    border-radius:50px;
    margin-top:-110;
    text-align:left;
    /* box-shadow:0 2px 5px rgb(0,0,0,0.2); */
}
.popup h2{
    margin-top:38px;
    font-size:500;
    font-weight:30px 0px 10px;
    box-shadow:0 2px 2px #101010;
    text-align:center;
    color:#87CEEB;
}
.popup Button{
    /* width:5%; */
    margin-top:0px;
    /* padding:10px 0; */
    /* background:#87CEEB;  */
    color:#fff;
    border:0;
    /* outline:none;   */
    /* font-size:18px; */
    /* font-weight:500; */
    border-radius:4px;
    cursor:pointer;

}


  .tab thead tr th{

     font-size:15px;

  }







        </style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css "   rel="stylesheet " >

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

    <div class="container">
        <Button type="submit" class="btn" onclick="openpopup()">Ordonnance</Button>
        <div class="popup" id="popup">
            <img src="image/logoformulair.png" alt="">
            <h2>Medicaments</h2>






<!-- <div class="tableMed" style="height: 500px;overflow: scroll;"> -->

<div class="card-body">
            <a href="{{ route('PDFordonnance.pdf') }}" class="btn btn-success btn-sn" title="genererPDF">
            Imprimer
            </a>
            </div>

     <div class="table-responsive">
     <table  class="table tab" >
        <thead>
          <tr>
          <th>#</th>
            <th> Medicament</th>
            <th>Posologie</th>
            <th>Nombre d'unite</th>
            <th>Qsp</th>
            <th>Action</th>
          </tr>
        </thead>

<tbody>
    @foreach($ordonnance as $item)
          <tr>
          <td>{{$loop->iteration}}</td>
            <td>{{$item->medicament}}</td>
            <td>{{$item->posologie}}</td>
            <td>{{$item->nombre}}</td>
            <td>{{$item->qsp}}</td>


            <td>
              <a href="{{ url('/ord/' . $item->id) }}" title="voir medicament"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>voir</button> </a>
              <a href="{{ url('/ord/' . $item->id  . '/edit') }}" title="modifier medicament"> <button class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>edit</button></a>

              <form method="POST" action="{{ url('/ord/' . '/' .$item->id) }}" accept-charset="UTF-8" style="display:inline">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}

              <button type="submit" class="btn-danger btn-sm" title="supprimer medicament" onclick="return confirm('Confirm ?')"><i class="fa fa-eye" aria-hidden="true"></i>supp</button>
            </form>
            </td>
         </tr>
         @endforeach
</tbody>
</table>
</div>




          <div class="card-body">
            <a href="{{ url('/ord/create') }}" class="btn btn-success btn-sn" title="Add New medicament">
                Add New
            </a>
            </div>






            <Button type="submit" onclick="closepopup()">OK</Button>
            </div>
            <script>

                    let popup=document.getElementById('popup');

                    function openpopup()
                    {
                        popup.classList.add("open-popup");
                    }


                    function closepopup(){
                        popup.classList.remove("open-popup");
                    }
            </script>
</body>
</html>
--}}
