@component('mail::message')
# Welcome, {{ $details['fname'] }}!

Thanks for being part of {{ config('app.name') }}.We are thrilled to have you on board.

Here is your login information:

@component('mail::panel')
**Login Page:** {{ config('app.url')}}<br>
**Username:** {{ $details['email'] }}<br>
**Password:** {{ $details['password'] }}
@endcomponent


@component('mail::button', ['url' =>  config('app.url') ])
Open My Portal
@endcomponent

Consider changing your password after logging in.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
