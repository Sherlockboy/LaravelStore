<div class="col-span-2 flex justify-center">
    <button data-action="increment" onclick="updateCartItemQty({{$item->id}}, 'decrease')"
            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-400 w-full h-10 rounded-l">
        <span class="m-auto text-2xl">-</span>
    </button>
    <input type="number" id="item-qty-{{$item->id}}"
           class="focus:outline-none text-center w-full h-10 bg-white hover:text-black focus:text-black text-gray-700"
           name="custom-input-number" value="{{$item->qty}}"
           onchange="updateCartItemQty('{{$item->id}}', 'change')">
    <button data-action="increment" onclick="updateCartItemQty({{$item->id}}, 'increase')"
            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-400 w-full h-10  rounded-r cursor-pointer">
        <span class="m-auto text-2xl font-thin">+</span>
    </button>
</div>
<script>
    function updateCartItemQty(itemId, type) {
        let data = {
            'type': type
        };

        if (type === 'change') {
            let select = document.getElementById('item-qty-' + itemId);
            data.qty = select.value;
        }

        axios.patch('/cart/' + itemId, data);
        window.location.href = '{{url()->current()}}';
    }
</script>