@php /** @var \App\Models\Order $order */ @endphp
<hr/>
<div style="text-align: center;">{{ 'Order status: ' . $order->status }}</div>
<hr/>

|Product Image|Product Name|Price|Quantity|Subtotal|
|:-------------:|:------------:|:-----:|:--------:|:--------:|
@foreach($order->items as $item)
    |![smallImage]({{'/storage/' . $item->product->image}})|{{$item->product->name}}|{{number_format($item->product->price, 2)}}|{{$item->qty}}|{{number_format($item->qty * $item->product->price, 2)}}|
@endforeach
<hr>
<div style="text-align: center;"><div><strong>{{ __('Order Total: ')}}</strong>{{number_format($order->final_price, 2)}}</div></div>
<hr>
<div style="text-align: center;">
    <div><strong>{{ __('Full Name: ')}}</strong>{{$order->full_name}}</div>
    <div><strong>{{ __('Email: ')}}</strong>{{$order->email}}</div>
    <div><strong>{{ __('Country: ')}}</strong>{{$order->country}}</div>
    <div><strong>{{ __('City: ')}}</strong>{{$order->city}}</div>
    <div><strong>{{ __('Street: ')}}</strong>{{$order->street}}</div>
    <div><strong>{{ __('Zip: ')}}</strong>{{$order->zip}}</div>
    <div><strong>{{ __('Phone: ')}}</strong>{{$order->phone}}</div>
</div>
<hr>