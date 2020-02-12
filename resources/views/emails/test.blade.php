@component('mail::message')
# E-mail de teste

Teste do sistema {{ config('app.name') }}

@component('mail::button', ['url' => config('APP_URL')])
Botão
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
