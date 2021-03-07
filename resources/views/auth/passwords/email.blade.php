@extends('layouts.app')

@section('content')
    <img class="wave" src="{{asset('img/wave.png')}}">
    <div class="container">
        <div class="img">
            <img src="{{asset('img/forgot_password.svg')}}">
        </div>
        <div class="login-content">

            <form method="POST" action="{{route('password.email')}}">
                @csrf
                <img class="img_mobile" src="{{asset('img/logo.png')}}" >
                <br>
                @include('layouts.errors_success')
                <br>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">

                        <input type="email" id="email" name="email" placeholder="Email" value="{{old('email') }}"  required autocomplete="email" autofocus>
                    </div>
                </div>

                <br>

                <a href="{{route('login')}}">S'authentifier ?</a>

                <input type="submit" class="btn" value="réinitialiser le mot de passe">
            </form>
        </div>
    </div>
@endsection
