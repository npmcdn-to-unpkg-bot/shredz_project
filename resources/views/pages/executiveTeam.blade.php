@extends('themes.default.layout')

@section('content')

<main class="executive-team">
    <div class="banner">
        <h1>EXECUTIVE TEAM</h1>
    </div>
    <div class="execs">
        <div class="exec">
            <img src="{{ asset('images/exec-lal.png') }}">
            <div class="info">
                <h3>ARVIN LAL <span>CEO</span></h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                    in culpa qui officia deserunt mollit anim id est laborum
                </p>
            </div>
        </div>
        <div class="ghLine"></div>
        <div class="exec">
            <img src="{{ asset('images/exec-lal.png') }}">
            <div class="info">
                <h3>ARVIN LAL <span>CEO</span></h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                    in culpa qui officia deserunt mollit anim id est laborum
                </p>
            </div>
        </div>
    </div><!-- execs -->
</main>

@stop