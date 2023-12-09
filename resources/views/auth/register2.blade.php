@extends('layouts.app2')
@section('title')
    Sign Up | {{ config('app.name', 'Laravel') }}
@endsection
@section('styles')
    <style>
        p {
            color: #4e4e4e;
            font-weight: 300;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: "Roboto", sans-serif;
        }

        a {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
        }

        a:hover {
            text-decoration: none !important;
        }

        .content {
            padding: 7rem 0;
        }

        h2 {
            font-size: 20px;
        }

        .half,
        .half .container>.row {
            height: 100vh;
            min-height: 700px;
        }

        @media (max-width: 991.98px) {
            .half .bg {
                height: 200px;
            }
        }

        .half .contents {
            background: #f6f7fc;
        }

        .half .contents,
        .half .bg {
            width: 50%;
        }

        @media (max-width: 1199.98px) {

            .half .contents,
            .half .bg {
                width: 100%;
            }
        }

        .half .contents .form-control,
        .half .bg .form-control {
            border: none;
            -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            height: 54px;
            background: #fff;
        }

        .half .contents .form-control:active,
        .half .contents .form-control:focus,
        .half .bg .form-control:active,
        .half .bg .form-control:focus {
            outline: none;
            -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
        }

        .half .bg {
            background-size: cover;
            background-position: center;
        }

        .half a {
            color: #4e4e4e;
            text-decoration: underline;
        }

        .half .btn {
            height: 54px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .half .forgot-pass {
            position: relative;
            top: 2px;
            font-size: 14px;
        }

        .control {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            cursor: pointer;
            font-size: 14px;
        }

        .control .caption {
            position: relative;
            top: .2rem;
            color: #4e4e4e;
        }

        .control input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .control__indicator {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e6e6e6;
            border-radius: 4px;
        }

        .control--radio .control__indicator {
            border-radius: 50%;
        }

        .control:hover input~.control__indicator,
        .control input:focus~.control__indicator {
            background: #ccc;
        }

        .control input:checked~.control__indicator {
            background: #06BBCC;
        }

        .control:hover input:not([disabled]):checked~.control__indicator,
        .control input:checked:focus~.control__indicator {
            background: #06BBCC;
        }

        .control input:disabled~.control__indicator {
            background: #e6e6e6;
            opacity: 0.9;
            pointer-events: none;
        }

        .control__indicator:after {
            content: '\2714';
            position: absolute;
            display: none;
            font-size: 16px;
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
        }

        .control input:checked~.control__indicator:after {
            display: block;
            color: #fff;
        }

        .control--checkbox .control__indicator:after {
            top: 50%;
            left: 50%;
            margin-top: -1px;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .control--checkbox input:disabled~.control__indicator:after {
            border-color: #7b7b7b;
        }

        .control--checkbox input:disabled:checked~.control__indicator {
            background-color: #7e0cf5;
            opacity: .2;
        }

        .ml-auto {
            margin-left: auto
        }
    </style>
@endsection
@section('content')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('img/about.jpg');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Sign up to <strong>UAS</strong></h3>
                        <p class="mb-4">Enter the following information to signup</p>
                        <form method="POST" id="signup-form">
                            @csrf
                            <div class="form-group first mb-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" placeholder="your name" id="name"
                                    name="name" value="{{ old('name') }}">
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" placeholder="your-email@gmail.com" id="email"
                                    name="email" value={{ old('email') }}>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="form-group  mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Your Password" id="password"
                                    name="password">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="form-group last mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Your Password"
                                    id="password_confirmation" name="password_confirmation">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                            {{-- <input type="submit" value="Sign Up" class="btn btn-block btn-primary col-md-12"> --}}
                            <button class="g-recaptcha btn btn-block btn-primary col-md-12"
                                data-sitekey="6Lfi9SspAAAAAD4HWiJErU79kKviEUBnVGCbEh_h" data-callback='onSubmit'
                                data-action='submit'>Sign
                                Up</button>
                        </form>
                        <div class="mt-3">Already Have an account? <a href="{{ route('login') }}">Login</a></div>
                        <x-input-error :messages="$errors->get('human-verifiy')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("signup-form").submit();
        }
    </script>
@endsection
