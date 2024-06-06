{{-- @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <input type="text" name="role" value="patient" style="opacity: 0">
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}

{{-- @auth --}}
 {{-- @if (session()->has('insMed')) --}}
@extends('pere.mere')
@section('content')
@include('naveBarre.navBarAdmin')

    <table class="form-container-insMed">
        <form action="{{ route('enregisterMed.admin') }}" method="POST" class="formIns med">
            @csrf
            <fieldset><legend>iNSCRIRE PERSONNEL SOIGNANT</legend>
                <tr>
                    <td colspan="2" style="padding-left: 29%;padding-top: 20px;">
                        <input type="button" class="textinsMed solide" value="iNSCRIRE PERSONNEL SOIGNANT">
                    </td>
                </tr>
                <tr>
                        <td>
                            <div class="input-field-insMed">
                                <i class='bx bxs-user'></i>
                                <input type="text" placeholder="Prenom" name="prenom" required>
                            </div>
                        </td>
                        
                        <td>
                            <div class="input-field-insMed">
                            <i class='bx bxs-user'></i>
                            <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bx-home'></i>
                            <input type="text" placeholder="Adresse" name="adresse" required>
                        </div>
                    </td>
                    
                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bx-calendar'></i>
                        <input type="date" name="date_nai">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bx-female-sign'></i>
                            <select name="sexe">
                                <option>Femme</option>
                                <option>Homme</option>
                            </select>
                        </div>
                    </td>
                    
                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bx-group'></i>
                            <select name="statut">
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
                            <input id="email" type="email" class="c @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </td>
                    
                    <td>
                        <div class="input-field-insMed">
                            <i class='bx bxs-phone-incoming'></i>
                        <input type="number" placeholder="Telephone" name="tel" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="input-field-insMed">
                            <i class='bx bxs-user'></i>
                            <input type="text" value="ADMIN" name="role">
                        </div>
                    </td>
                    
                    <td>
                        <div class="input-field-insMed">
                        <i class='bx bxs-user'></i>
                        <input type="text" placeholder="Qualite" name="qualite" required>
                        <input id="password" type="password"  name="password" value="123456789">
                    <input id="password-confirm" type="password"  name="password_confirmation" value="123456789">
                        </div>
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="2" style="padding-left: 40%">
                        <input type="submit" class="btnn2 solide" value="Enregistrer">
                    </td>
                  
                </tr>
            </fieldset>
            
        </form>
    </table>
    
@endsection
{{-- @endif --}}