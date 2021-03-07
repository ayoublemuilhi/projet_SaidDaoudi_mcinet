@extends('layouts.app')

@section('content')
    <img class="wave" src="{{asset('img/wave.png')}}">
    <div class="container">
        <div class="img">
            <img src="{{asset('img/reset.svg')}}">
        </div>
        <div class="login-content">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <img class="img_mobile" src="{{asset('img/logo.png')}}" >
                @include('layouts.errors_success')
                <br>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input type="email" id="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}"  required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input id="password" type="password" name="password" placeholder="Mot de Passe" required autocomplete="new-password">
                    </div>
                </div>


                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmer le Mot de Passe" required autocomplete="new-password">
                    </div>
                </div>

                <br>

                <a href="{{route('login')}}">S'authentifier ?</a>

                <input type="submit" class="btn" value="réinitialiser le mot de passe">
            </form>
        </div>
    </div>
@endsection
