@extends('layouts.app')

@section('content')
    <img class="wave" src="{{asset('img/wave.png')}}">
    <div class="container">
        <div class="img">
            <img src="{{asset('img/bg.svg')}}">
        </div>
        <div class="login-content">
            <form action="index.html">
                <img class="img_mobile" src="{{asset('img/logo.png')}}" >
                <h2 class="title"></h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Mot De Passe</h5>
                        <input type="password" class="input">
                    </div>
                </div>
                <br>
                @if (Route::has('password.request'))
                <a href="{{route('password.request')}}">Mot de passe oublié ?</a>
                @endif
                <input type="submit" class="btn" value="S'authentifier">
            </form>
        </div>
    </div>
@endsection
