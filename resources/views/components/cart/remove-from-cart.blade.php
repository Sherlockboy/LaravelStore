<div>
    <button onclick="removeFromCart({{$cartItemId}})">{{ __('Remove product') }}</button>
</div>
<script>
    function removeFromCart(cartItemId) {
        if (confirm('Are you sure you want to remove product from your cart?')) {
            axios.delete('/cart/' + cartItemId)
                .then(response => {
                    alert(response.data.name + ' was removed from your cart');
                    window.location.href = '/cart';
                })
        }

    }
</script>