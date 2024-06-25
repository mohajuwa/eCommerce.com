@component('mail::message')

<h2 style="text-align:center;color:#333;">Order Invoice</h2>
<p>Dear {{ $order->first_name }} {{ $order->last_name }},</p>
<p>Thank you for your recent purchase with <strong>{{ config('app.name') }}</strong>. We are pleased to confirm your
    order and have attached the invoice for your records.</p>

<h3>Order Details:</h3>
<ul>
    <li>Order Number: #{{ $order->order_number }}</li>
    <li>Date of Purchase: {{ date('d-m-Y h:i A', strtotime($order->created_at)) }}</li>

</ul>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <thead>
        <tr>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Item</th>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Quantity</th>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Price</th>
            <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->getItem as $item)
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                @if(isset($item->product))
                <a href="{{ url($item->product->slug) }}" class="link-black" target="_blank" rel="noopener noreferrer">
                    {{ $item->product->title }}
                </a>
                @else
                N/A
                @endif
                <br>
                @if(!empty($item->color_name))
                Color: {{ $item->color_name }}
                <br>
                @endif
                @if(!empty($item->size_name))
                Size: {{ $item->size_name }}
                <br>
                Size Amount: ${{ number_format($item->size_amount, 2) }}
                @endif
            </td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">${{ number_format($item->price, 2) }}</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">${{ number_format($item->total_price, 2) }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
@if(!empty($order->getShipping))
<p>Shipping Name: <b>{{ $order->getShipping->name }}</b></p>
@endif

@if(!empty($order->shipping_amount))
<p>Shipping Amount: <b>${{ number_format($order->shipping_amount, 2) }}</b></p>
@endif

@if(!empty($order->discount_code))
<p>Discount Code: <b>{{ $order->discount_code }}</b></p>
@endif

@if(!empty($order->discount_amount))
<p>Discount Amount: <b>${{ number_format($order->discount_amount, 2) }}</b></p>
@endif

@if(!empty($order->total_amount))
<p>Total Amount: <b>${{ number_format($order->total_amount, 2) }}</b></p>
@endif

@if(!empty($order->payment_method))
<p style="text-transform: capitalize">Payment Method: <b>{{ $order->payment_method }}</b></p>
@endif


<p>Please find the attached invoice for your reference. If you have any questions or concerns regarding your order or
    the invoice, feel free to contact us at <strong>{{ config('app.name') }}</strong>.</p>

<p>Thank you for choosing <strong>{{ config('app.name') }}</strong>. We appreciate your business.</p>

{{ config('app.name') }}
@endcomponent