<div>
    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
            onclick="{{auth()->user() ? 'prepareAndPlace()' : 'prepareAndPlaceGuest()'}}">{{ __('Place Order') }}</button>
</div>
<script>
    function prepareAndPlace() {
        let select = document.getElementById('delivery-address');
        let addressOption = select.options[select.selectedIndex];

        if (addressOption) {
            let data = {'addressId': addressOption.value};
                place(data);
        } else {
            alert('Please, select delivery address');
        }
    }

    function prepareAndPlaceGuest()
    {
        let data = {
            'country': document.getElementById('country').value,
            'city': document.getElementById('city').value,
            'street': document.getElementById('street').value,
            'zip': document.getElementById('zip').value,
            'phone': document.getElementById('phone').value,
        }

        place(data)
    }

    function place(data) {
        axios.post('/order/create', data)
            .then(response => {
                alert('Order was created!');
                window.location.href = '{{ route('checkout.success') }}' + '?orderId=' + response.data.orderId
            })
    }
</script>