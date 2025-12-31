@component('mail::message')
    # Zahlungsbestätigung

    Hallo {{ $paymentDetails['name'] }},

    {{$paymentDetails['street']}}
    {{$paymentDetails['postcode']}}
    {{$paymentDetails['city']}}
    Summe={{$paymentDetails['anzahl']}}.00€

    <h1>vielen Dank für deine Zahlung</h1>





    Vielen Dank für deinen Einkauf!

@endcomponent
