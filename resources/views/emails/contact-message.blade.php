<x-mail::message>
# New Contact Message

**Name:** {{ $contactMessage->name }}
**Email:** {{ $contactMessage->email }}
@if($contactMessage->phone)
**Phone:** {{ $contactMessage->phone }}
@endif

**Message:**

{{ $contactMessage->message }}

<x-mail::button :url="url('/admin/contact-messages')">
View in Admin
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
