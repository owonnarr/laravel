@component('mail::message')

    
<h2 style="color: #0c5460">{{ $email }} {{ $user }}</h2>
<hr>
<p>{{ $msg }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

