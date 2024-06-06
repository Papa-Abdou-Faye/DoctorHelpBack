
    <nav class="sidebar fermer">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="{{ asset('image/lo1.png') }}" style="height: 140px">
                </span>
                <div class="text header-text">
                    <a href="{{ route('accInfirmier') }}" style="text-decoration: none; color: white"><span class="name">DOCTOR's help</span></a>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar" >
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="{{ route('accInfirmier') }}">
                            <i class='bx bx-home-heart icons'></i>
                            <span class="text nav-text">Accueil</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{ route('consultation.med') }}">
                            <i class='bx bxs-user-badge icons'></i>
                            <span class="text nav-text">Consultation</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('doc') }}">
                            <i class='bx bxs-book-bookmark icons'></i>
                            <span class="text nav-text">Documentation</span>
                        </a>
                    </li>
            </div>
            <div class="bottom-content">

                <li class="" style="list-style: none; height: 30px;">
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
        <button onclick="openpopup()" style="float: right!important; border:none; background: none">  <i class='bx bxs-lock-alt icons' style="float: right!important; margin-top: 25px; color: white;   font-size: 1.8rem;"></i></button>
        <button onclick="openpopup2()" style="float: right!important; border:none; background: none">  <i class='bx bxs-info-circle' style="float: right!important; margin-top: 25px; color: white ;font-size: 1.8rem;"></i></button>
        <button onclick="openpopupConsult()" style="float: right!important; border:none; background: none">  <i class='bx bxl-skype icons' style="float: right!important; margin-top: 25px; color: white ;font-size: 1.8rem;"></i></button>
        @if (Auth::user()->role == 'MEDECINCHEF')
            <a href="{{ route('book') }}">
                <button  style="float: right!important; border:none; background: none">  <i class='bx bxs-registered icons' style="float: right!important; margin-top: 25px; color: white ;font-size: 1.8rem;"></i></button>
            </a>
            <button onclick="openpopupConsult2()" style="float: right!important; border:none; background: none">  <i class='bx bxl-pinterest icons' style="float: right!important; margin-top: 25px; color: white ;font-size: 1.8rem;"></i></button>
            <button onclick="openpopupConsult1()" style="float: right!important; border:none; background: none">  <i class='bx bxs-user-plus icons' style="float: right!important; margin-top: 25px; color: white ;font-size: 1.9rem;"></i></button>
        @endif

    </nav>
