<button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
        onclick="clearCart()">{{ __('Clear shopping cart') }}</button>
<script>
    function clearCart() {
        if (confirm('Are you sure you want to clear your shopping cart?')) {
            axios.delete('/cart')
                .then(response => {
                    alert('Your shopping cart was cleared');
                    window.location.href = '/cart';
                })
        }

    }
</script>