@component('mail::message')

<h1 style="text-align: center;">
    Felicitation {{ $business_logo->name }}, la soumission du logo pour votre entreprise {{ $business_logo->business_name }} a été prise en compte
</h1>

Votre requête sera traitée. Nous vous enverrons un mail de validation ou de rejet de votre logo après traitement

En cas de problèmes ou de suggestions, Vous pouvez nous écrire sur ce mail

Et pour soumettre un autre logo, vous pouvez cliquer sur <a href="https://ci-logos.com/submission">SOUMETTRE</a>

Merci,<br>
{{ config('app.name') }}
@endcomponent
