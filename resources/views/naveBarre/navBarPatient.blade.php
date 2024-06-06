
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
        <div class="menu-bar" >
            <div class="menu" >
                <ul class="menu-links" >
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('profil') }}">
                            <i class='bx bx-home-heart icons'></i>
                            <span class="text nav-text">Profil</span>
                        </a>
                    </li>
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('dossierforpatient') }}">
                            <i class='bx bxl-meta icons'></i>
                            <span class="text nav-text">Dossiers</span>
                        </a>
                    </li>
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('ordforpatient') }}">
                            <i class='bx bxl-meta icons'></i>
                            <span class="text nav-text">Ordennances</span>
                        </a>
                    </li>
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('paraforpatient') }}">
                            <i class='bx bxl-medium-old icons'></i>
                            <span class="text nav-text">Paracliniques</span>
                        </a>
                    </li>
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('Antece') }}">
                            <i class='bx bx-dizzy icons'></i>
                            <span class="text nav-text">Antecedents</span>
                        </a>
                    </li>
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('Terr') }}">
                            <i class='bx bxs-dizzy icons' ></i>
                            <span class="text nav-text">Terrains</span>
                        </a>
                    </li>
                    <li class="nav-link" style="height: 40px">
                        <a href="{{ route('rvforpatient') }}">
                            <i class='bx bxs-contact icons'></i>
                            <span class="text nav-text">Rendez-Vous</span>
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
        <span class="name">{{ Auth::user()->prenom}} {{ Auth::user()->nom }} </span>
        <?php  $aujourdhui = date("D-M-Y"); ?>
        <span style="background-color: none;color: rgb(218, 214, 214);font-size:20px; z-index: 40; margin-top: 50%; margin-left : 15%; font-family:robot"> <?php echo $aujourdhui ?></span>
        <span id='horloge' style="background-color: none;color: white;font-size:40px; z-index: 40; margin-top: 50%;  font-family:robot"></span>
           <button type="submit"  onclick="openpopup()" style="float: right!important; border:none"> <img src="{{ asset('image/proAdmin.png') }} " style=" width: 80px; float: right!important;"> </button>

    </nav>

