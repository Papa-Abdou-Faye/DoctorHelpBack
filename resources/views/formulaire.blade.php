<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('naveBarre.styl')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>DOCTOR'S HELP</title>
</head>
<body>
    {{-- signin-signup --}}
    <div class="container-fluid">
        <div class="forms-container">
        <div class="signin-signup">
            <form action="{{ route('acc.admin') }}" class="sign-in-form" method="POST">
                {{-- pour des mesures de securite de lara vel on ajoute @csrf --}}
                @csrf
                {{-- <h2 class="title"><strong> DOCTOR'S HELP </strong></h2> --}}
                <img src="{{ asset('image/logoformulair.png') }}" class="logo logo--wut">
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="email" placeholder="Email" name="login" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alerte">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('mot de passe')
                                    <span class="invalid-feedback" role="alerte">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <input type="submit" class="btnn solide" value="Connexion">
                <p class="social-text"> <strong>DOCTOR'S HELP</strong> pour une vie meilleure </p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </form>
        </div>

        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>DOCTOR'S HELP</h3>
                    <p>Un suivi patient est un processus permettant de suivre le parcours d’un patient tout au
                        long de ses soins en facilitant la traçabilité de ses interactions avec le personnel soignant.</p>
                        <button class="btnn transparent" id="sign-up-button"><strong> PROPOS </strong></button>
                </div>
                <img src="{{ asset('image/d3.svg') }}" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    {{-- <img src="{{ asset('image/femme.png') }}" class="image"> --}}
                    <h3>A PROPOS</h3>
                    <p>L’état du Sénégal, de par son grand potentiel et son expertise humain, est devenu le hub ouest-africain pour les services de la santé en général  et ambitionne davantage de faire du secteur sanitaire un levier
                        de croissance durable car il n’y a aucune chose qui vaille plus que la santé.</p>
                        <button class="btnn transparent" id="sign-in-button"><strong> ACCUEIL </strong></button>
                </div>
                <img src="{{ asset('image/d1.svg') }}" class="image">
            </div>
        </div>
    </div>
   <script>
        const sign_up_btn = document.querySelector("#sign-up-button");
        const sign_in_btn = document.querySelector("#sign-in-button");
        const container = document.querySelector('.container-fluid');
        sign_up_btn.addEventListener('click',() =>{ container.classList.add('sign-up-mode');});
        sign_in_btn.addEventListener('click',() =>{ container.classList.remove('sign-up-mode');});
   </script>
</body>
</html>
