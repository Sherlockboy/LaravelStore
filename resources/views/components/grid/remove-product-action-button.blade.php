<div>
    <button class="inline-flex px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mt-2"
            onclick="removeAction({{$itemId}}, '{{$entityType}}')">{{ __('Remove from ' . $entityType) }}</button>
</div>
<script>
    function removeAction(itemId, entityType) {
        if (confirm('Are you sure you want to remove product from your ' + entityType + '?')) {
            axios.delete('/' + entityType + '/' + itemId)
                .then(response => {
                    alert(response.data.name + ' was removed from your ' + entityType);
                    window.location.href = '{{url()->current()}}';
                })
        }
    }
</script>