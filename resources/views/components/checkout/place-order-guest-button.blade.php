<div>
    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
            onclick="placeOrder()">{{ __('Place Order') }}</button>
</div>
<script>
    function placeOrder() {
        let data = {
            'full_name': document.getElementById('full_name').value,
            'email': document.getElementById('email').value,
            'country': document.getElementById('country').value,
            'city': document.getElementById('city').value,
            'street': document.getElementById('street').value,
            'zip': document.getElementById('zip').value,
            'phone': document.getElementById('phone').value,
        }

        axios.post('/order/create', data)
            .then(response => {
                alert('Order was created!');
                window.location.href = '{{ route('checkout.success') }}' + '?orderId=' + response.data.orderId
            })
    }
</script>