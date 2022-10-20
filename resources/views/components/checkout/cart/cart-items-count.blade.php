<div id="cart-items-count"></div>
<script>
    /*
    TODO: This MUST be refactored. Each page load now triggers request to backend. Request should be triggered only
    TODO: if cart item qty changes
    */
    window.onload = function () {
        return getItemsCount();
    }

    function getItemsCount() {
        axios.get('/cart/get-items-count').then(response => {
            if (response.data.count > 0) {
                document.getElementById('cart-items-count').innerHTML =
                    '<span class="ml-1 rounded-full w-6 h-6 bg-blue-300 flex items-center justify-center">' +
                    response.data.count +
                    '</span>'
            }
        })
    }
</script>