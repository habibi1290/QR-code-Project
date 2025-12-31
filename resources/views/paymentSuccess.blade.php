@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="wrapper payment_success">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center">
                    <div class="background">
                        <h1>Zahlung erfolgreich</h1>
                        <h2>Sie haben eine Zahlungsbestätigung und QR-Code Per Mail bekommen</h2>
                        <a href="{{route('home')}}" class="back-to-home-btn">zurück zur Startseite</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
