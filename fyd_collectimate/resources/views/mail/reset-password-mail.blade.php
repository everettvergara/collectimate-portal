<x-mail::message>

# User Password Request

We have received your request. Please click the button below to to change your password. Please know that the link expires after 7 days.

@component('mail::button', ['url' => $url])
    Activate Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
