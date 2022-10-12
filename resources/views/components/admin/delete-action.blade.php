<div>
    <button onclick="deleteEntity({{$entityId}}, '{{$entityName}}')">{{ __('Delete') }}</button>
</div>
<script>
    function deleteEntity(entityId, entityName) {
        if (confirm('Are you sure you want to delete ' + entityName + ' with id ' + entityId +'?')) {
            axios.delete( '/' + entityName + '/' + entityId)
                .then(response => {
                    alert(response.data.name + ' was deleted');
                    window.location.href = '/admin/' + entityName;
                })
        }
    }
</script>