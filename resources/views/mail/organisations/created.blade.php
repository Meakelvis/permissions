@component('mail::message')

Dear {{ $user->name }},<br>
Your organisation has been created.<br>
<a href="{{ config('app.url') }}">Click here</a> to sign onto the application with the following credentials.


Email: {{ $user->email }}<br>
Password: {{ $password }}


Thanks,<br>
Ministry of Work & Transport, Uganda - {{ config('app.name') }}
@endcomponent
