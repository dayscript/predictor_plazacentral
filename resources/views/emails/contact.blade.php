@component('mail::message')
# Nuevo envío de contacto

Se ha enviado un formulario de contacto con la siguiente información:

@component('mail::table')
| Campo | Valor |
| ------------- |:-------------:|
| Nombre | {{ $data['name'] }} |
| Apellido | {{ $data['last'] }} |
| E-Mail | {{ $data['email'] }} |
| Teléfono | {{ $data['phone'] }} |
| Pais | {{ $data['country'] }} |
| Ciudad | {{ $data['city'] }} |
| Mensaje | {{ $data['message'] }} |
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
