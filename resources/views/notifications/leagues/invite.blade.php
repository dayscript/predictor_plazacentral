@component('mail::message')
# Hola, tienes una invitación a unirte a una liga!

Has sido invitado a unirte a la liga: **{{ $league->name }}**, creada por {{ $league->user->full_name }}.

El código de la liga es: **{{ $league->code }}**.

@if($password)
Como no te has registrado en nuestro sitio, hemos preparado una cuenta para ti, puedes acceder usando las siguientes credenciales:

Email: **{{ $email }}**
Contraseña: **{{ $password }}**
@endif
@component('mail::button', ['url' => $url])
    Unirme a esta liga
@endcomponent

Gracias por participar en Predictor!,<br>
{{ config('app.name') }}
@endcomponent
