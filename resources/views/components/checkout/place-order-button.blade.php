<div>
    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
            onclick="placeOrder()" id="place-order-button">{{ __('Place Order') }}</button>
</div>
<script>
    function placeOrder() {
        document.getElementById('place-order-button').disabled = true;
        let select = document.getElementById('delivery-address');
        let addressOption = select.options[select.selectedIndex];

        if (addressOption) {
            let data = {'addressId': addressOption.value};
            axios.post('{{ route('order.create') }}', data)
                .then(response => {
                    alert('Order was created!');
                    window.location.href = '{{ route('checkout.success') }}' + '?orderId=' + response.data.orderId
                }, error => {
                    alert(error.response.data.message)
                    document.getElementById('place-order-button').disabled = false;
                })
        } else {
            alert('Please, select delivery address');
            document.getElementById('place-order-button').disabled = false;
        }
    }
</script>