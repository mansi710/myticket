

@component('mail::message')
youhave some reminders below are details

The body of your message.

@component('mail::table')
|Ticket_NAME|STATUS
|:-----------|:------|

@foreach($tickets as $ticket)
|{{$ticket['ticket_name']}}|{{$ticket['status']}}|
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
