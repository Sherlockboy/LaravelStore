<span id="cart-items-count-span" class="ml-1 rounded-full w-6 h-6 bg-blue-300 flex items-center justify-center">
    <!-- TODO: How this call can be replaced? Cache? -->
{{ \App\Models\Cart::getCart(false) ? \App\Models\Cart::getCart()->getTotalItemQty() : 0}}
</span>
<script>
    function updateCartItemCountSpan(qty) {
        document.getElementById('cart-items-count-span').innerHTML = qty
    }
</script>