@extends('layout')

@section('content')

<div class="container-fluid container_register_page"  style="padding:0; margin:0;">
    <div class="row">
        <div class="wrapper_register_page">
            <form action="{{route('paypal.payment')}}" autocomplete="off" class="form-horizontal" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName2">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="Nachname Vorname" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputName2">Straße</label>
                    <input type="text" name="street" class="form-control" id="exampleInputName2" placeholder="Straße Hausnr" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputName2">Stadt</label>
                    <input type="text" name="city" class="form-control" id="exampleInputName2" placeholder="Stadt" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputName2">Postleitzahl</label>
                    <input type="number" name="postcode" class="form-control" id="exampleInputName2" placeholder="plz" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputName2">Anzahl der Personen</label>
                    <input type="number" id="zahl" name="zahl" class="form-control"  placeholder="Anzahl der Personen" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="maxmustermann@example.com" required>
                </div>

                <p class="summe">Summe: <strong><span id="summe" class="summe">0.00</span> €</strong></p>
                <input type="hidden" name="amount" id="amount">

                <button type="submit" class="btn btn-success">
                    Pay with PayPal
                </button>
            </form>
        </div>
    </div>
</div>


@endsection
