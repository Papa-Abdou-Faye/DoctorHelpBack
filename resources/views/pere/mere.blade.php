<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #preview{
    z-index: 41;
    height: 100%;
    width: 100%;
    margin: 0 auto;
}
.scanner{
    width: 100%;
    height: 5px;
    background-color:#b9ffff;
    opacity: 1;
    position: relative;
    box-shadow: 0px 0px 2px 4px #9ff8f1;
    top: 50%;
    animation-name: scan;
    animation-duration: 4s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-play-state: paused;
}
@keyframes scan {
    0%{
        box-shadow: 0px 0px 8px 10px #b9fdff;
        top: 50%;
    }
    25%{
        box-shadow: 0px 6px 8px 10px #aef7ea;
        top: 5px;
    }
    75%{
        box-shadow: 0px -6px 8px 10px #91ebe6;
        top: 90%;
    }
}
.card{
    display: grid;
    grid-template-columns: 300px;
    grid-template-rows: 300;
    background: white;
}
.card .wrapper{
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 10px;
    height: 200px;
}
.wrapper .scanner{
    animation-play-state: running;
    z-index: 42;
}
    </style>
    <!-- Boxicons CSS -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @include('naveBarre.styl')
    <script type="text/javascript">
        function refresh(){
            var t = 1000; // rafraîchissement en millisecondesz
            setTimeout('showDate()',t)
        }

        function showDate() {
            var date = new Date()
            var h = date.getHours();
            var m = date.getMinutes();
            var s = date.getSeconds();
            if( h < 10 ){ h = '0' + h; }
            if( m < 10 ){ m = '0' + m; }
            if( s < 10 ){ s = '0' + s; }
            var time = h + ':' + m + ':' + s
            document.getElementById('horloge').innerHTML = time;
            refresh();
         }
     </script>

    <title>DOCTOR'S help</title>
</head>
<body onload=showDate(); style="background: gainsboro" id="body" >
    @yield('content')
    @include('naveBarre.jsss')
</body>
</html>
