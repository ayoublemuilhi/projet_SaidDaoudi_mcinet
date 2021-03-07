@extends('layouts.app')

@section('content')
    <img class="wave" src="{{asset('img/wave.png')}}">
    <div class="container">
        <div class="img">
            <img src="{{asset('img/Confirmation.svg')}}">
        </div>


        <div class="login-content">
            <form method="POST" action="{{route('password.confirm')}}">
                @csrf
                <img class="img_mobile" src="{{asset('img/logo.png')}}" >
                <br>
                <h4>Veuillez confirmer votre mot de passe avant de continuer</h4>
                @include('layouts.errors_success')
                <br>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input id="password" type="password"  name="password" placeholder="Mot de passe actuel" required autocomplete="current-password">
                    </div>
                </div>

                <br>

                @if (Route::has('password.request'))
                    <a  href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif


                <input type="submit" class="btn" value="Confirmez le mot de passe">
            </form>
        </div>
    </div>
@endsection
