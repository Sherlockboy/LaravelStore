<button onclick="addToWishList({{$isInWishlist}}, {{$productId}})">
    {{ $isInWishlist ? __('Remove from wishlist') : __('Add to wishlist') }}
</button>
<script>
    function addToWishList(isInWishList, productId) {
        axios.post('/wishlist/' + productId, {
            'isInWishlist': isInWishList
        }).then(response => {
            alert(response.data.name +' was {{$isInWishlist ? 'removed from' : 'added to'}} your wishlist');
            window.location.href = ('{{url()->current()}}');
        })
    }
</script>