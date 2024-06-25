@component('mail::message')
Hi Admin,

<p><b>Name:</b> {{ $user->name }}</p>

<p><b>Email:</b> {{ $user->email }}</p>

<p><b>Phone:</b> {{ $user->phone }}</p>

<p><b>Subject:</b> {{ $user->subject }}</p>

<p><b>Message:</b> {{ $user->message }}</p>
@endcomponent