@component('mail::message')

Hi <b>{{$user->name}}</b>,
<p>You're almost ready to start enjoing the benefits of ecommerce.com </p>
<p>Simply click the button below to verify your email address .</p>

@component('mail::button',['url'=> url('activate/'.base64_encode($user->id))])
Verify

@endcomponent

<p>This will verify your email address , and then you'll officially be a part of the ecommerce.com </p>
@endcomponent