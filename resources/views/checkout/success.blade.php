<x-header title="{{ __('Thank you for your order!') }}"/>
<div class="grid grid-rows">
    <div class="flex justify-center">
        <p class="text-xl">
            {{ __('Yor order id is # ')}}
            @auth()
                <a href="{{ route('order.show', $orderId) }}">
                    {{$orderId}}
                </a>
                {{ __('You can view order details in your account') }}
            @else
                {{$orderId}}
            @endauth
        </p>
    </div>
</div>