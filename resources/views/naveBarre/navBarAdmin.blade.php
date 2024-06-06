
    <nav class="sidebar fermer">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('image/lo1.png') }}" style="height: 140px">
                </span>
                <div class="text header-text">
                    <a href="#" style="text-decoration: none; color: white"><span class="name">DOCTOR's help</span></a>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="{{ route('acc.admin') }}">
                            <i class='bx bx-home-heart icons'></i>
                            <span class="text nav-text">Accueil</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('list.med') }}" >
                            <i class='bx bx-briefcase icons'></i>
                            <span class="text nav-text">Personnels</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        {{-- <a href="{{ route('inscrir.med') }}"> --}}
                            <a href="{{ route('inscrir.med') }}">
                            <i class='bx bx-book-add icons' ></i>
                            <span class="text nav-text">Inscription</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        {{-- <a href="{{ route('inscrir.med') }}"> --}}
                            <a href="{{ route('stricture') }}">
                            <i class='bx bx-book-add icons' ></i>
                            <span class="text nav-text">Stricture</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('pageqrcode.admin') }}">
                            <i class='bx bx-qr-scan icons' ></i>
                            <span class="text nav-text">QR-code</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('qrList.admin') }}">
                            <i class='bx bx-qr icons' ></i>
                            <span class="text nav-text">Liste QRcode</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('anomalie.admin') }}">
                            <i class='bx bxs-dizzy icons' ></i>
                            <span class="text nav-text">Pathologie</span>
                        </a>
                    </li>

            </div>
            <div class="bottom-content">

                <li class="" style="list-style: none">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out icons'></i>
                        <span class="text nav-text">Deconnexion</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li class="mode" style="list-style: none" >
                    <div class="moon-sun">
                        <i class='bx bxs-color icons moon'></i>
                    </div>
                    <span class="mode-text nav-text"></span>
                   <div class="toggle-switch">
                        <span class="switch"></span>
                   </div>

                </li>
            </div>
        </div>
    </nav>
    <nav class="top ferme">

        {{-- <span class="name">{{ Auth::user()->prenom}} {{ Auth::user()->nom }} </span> --}}
        <?php  $aujourdhui = date("D-M-Y"); ?>
        <span style="background-color: none;color: rgb(218, 214, 214);font-size:20px; z-index: 40; margin-top: 50%; margin-left : 15%; font-family:robot"> <?php echo $aujourdhui ?></span>
        <span id='horloge' style="background-color: none;color: white;font-size:40px; z-index: 40; margin-top: 50%;  font-family:robot"></span>
        <button type="submit"  onclick="openpopup()" style="float: right!important; border:none"> <img src="{{ asset('image/proAdmin.png') }} " style=" width: 80px; float: right!important;"> </button>
    </nav>

