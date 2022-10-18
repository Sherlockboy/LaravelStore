@php /** @var \App\Models\Order $order */@endphp
@component('mail::message')
    # <div style="text-align: center;">Dear {{$order->full_name}}</div>
<br>Thank you for tou purchase from {{ config('app.name') }}!
@component('mail.markdown.order-details', ['order' => $order])

@endcomponent
@if(!$order->is_guest)
<br>
<div style="text-align: center;">You can view your order details here:</div>
@component('mail::button', ['url' => route('order.show', $order->id)])
    View Order
@endcomponent
@endif
Thanks, <br>
{{ config('app.name') }}
@endcomponent
<style>
    img[alt=smallImage] {
        width: 100px
    }
</style>
