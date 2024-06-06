@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')
    <table class="form-container-insMed">

        <form action="{{ route('enregisterMed.admin') }}" method="POST" class="formIns med">
            @csrf

            <fieldset><legend>iNSCRIRPTION PERSONNEL SOIGNANT</legend>
                <tr>

                    <td colspan="2" style="padding-left: 29%;padding-top: 20px;">
                        <input type="button" class="textinsMed solide" value="iNSCRIRE PERSONNEL SOIGNANT">
                    </td>
                </tr>
                @if (session()->has('succes'))
                <tr>
                    <td colspan="2">
                    <p class="alert alert-warning" style="text-align: center" role="alert">
                        {{ session()->get('succes') }}
                    </p>
                    </td>
                </tr>
                @endif
                    <tr>
                        <td>
                            <div class="input-field-insMed">
                                <i class='bx bxs-user'></i>
                                <input type="text" placeholder="Prenom" name="prenom" class=" @error('prenom') is-invalid @enderror"  value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                            </div>
                        </td>

                        <td>
                            <div class="input-field-insMed">
                            <i class='bx bxs-user'></i>
                            <input type="text" placeholder="Nom" name="nom" class=" @error('nom') is-invalid @enderror"  value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                            </div>
                        </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bx-home'></i>
                            <input type="text" placeholder="Adresse" name="adresse" class=" @error('adresse') is-invalid @enderror"  value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bx-calendar'></i>
                        <input type="date" name="date_nai" class=" @error('date_nai') is-invalid @enderror" value="{{ old('date_nai') }}" required autocomplete="date_nai" autofocus>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bx-female-sign'></i>
                            <select name="sexe"  class=" @error('sexe') is-invalid @enderror" value="{{ old('sexe') }}" required autocomplete="sexe" autofocus>
                                <option>Femme</option>
                                <option>Homme</option>
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bx-group'></i>
                            <select name="statut" class=" @error('statut') is-invalid @enderror" value="{{ old('statut') }}" required autocomplete="statut" autofocus>
                                <option>Marié</option>
                                <option>celibataire</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bx-envelope'></i>
                            <input type="email" placeholder="Email" name="email" class=" @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bxs-phone-incoming'></i>
                        <input type="number" placeholder="Telephone" name="tel"class=" @error('tel') is-invalid @enderror" value="{{ old('tel') }}" required autocomplete="tel" autofocus>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bxs-user'></i>
                            <select name="stricture"  class=" @error('stricture') is-invalid @enderror" value="{{ old('stricture') }}" required autocomplete="stricture" autofocus>
                                @foreach ($strictures as $s)
                                    <option>{{$s->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>

                    <td>
                        <div class="input-field-insMed">
                        <i class='bx bxs-user'></i>
                        <select name="role"  class=" @error('qualite') is-invalid @enderror" value="{{ old('qualite') }}" required autocomplete="qualite" autofocus>
                            <option>MEDECIN</option>
                            <option>MEDECINCHEF</option>
                            <option>INFIRMIER</option>
                            <option>SAGEFEMME</option>
                            <OPtion>CAISSIER</OPtion>
                            <option>SECRETAIRE</option>
                        </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <input type="password" placeholder="passs" name="password" value="1234" style="opacity: 0;">
                    <input type="password" placeholder="passs" name="password_confirmation" value="1234" style="opacity: 0;">
                    <td colspan="2" style="padding-left: 40%">
    @if ($errors->any())
            <div class="alert alert-danger" style="text-align: center; float: right!important;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <input type="submit" class="btnn2 solide" value="Enregistrer">
                    </td>
                </tr>
            </fieldset>

        </form>
    </table>

@endsection
