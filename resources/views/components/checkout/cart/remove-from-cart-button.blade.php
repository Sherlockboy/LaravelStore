<button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
        onclick="removeFromCart()">{{ __('Remove from cart') }}</button>
<script>
    function removeFromCart() {
        if (confirm('Are you sure you want to remove product from your cart?')) {
            axios.delete('{{route('cart.destroy', $itemId)}}')
                .then(response => {
                    alert(response.data.name + ' was removed from your cart');
                    window.location.href = '{{route('cart.index')}}';
                })
        }
    }
</script>
