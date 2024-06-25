@component('mail::message')

Hello <b>{{$user->name}}</b>

<p>We understand it happens.</p>

@component('mail::button',['url'=> url('reset/'.$user->remember_token)])
Reset Your Password
@endcomponent



<p>In case you have any issues recoverin your password , plaese contac us. </p>
Thanks, <br />
{{
config('app.name')
}}
@endcomponent