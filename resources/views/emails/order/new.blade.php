@php /** @var \App\Models\Order $order */@endphp
@component('mail::message')
    # Dear {{$order->full_name}}

Thank you for tou purchase from {{ config('app.name') }}!
@if(!$isGuest)
You can view your order details here:
@component('mail::button', ['url' => route('order.show', $order->id)])
View Order
@endcomponent
@endif
Thanks,<br>
{{ config('app.name') }}
@endcomponent
