<script>
    function deleteItem(table, url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        _token: @json(@csrf_token())
                    },
                    success: function (response) {
                        if (response) {
                            Snackbar.show({
                                text: '{{ __('success.delete') }}',
                                textColor: '#ddf5f0',
                                backgroundColor: '#00ab55',
                                actionText: '{{ __('general.common.dismiss') }}',
                                actionTextColor: '#3b3f5c'
                            });
                            table.ajax.reload();
                        }
                    },
                    error: function (response) {
                        Snackbar.show({
                            text: '{{ __('error.delete') }}',
                            textColor: '#fbeced',
                            backgroundColor: '#e7515a',
                            actionText: '{{ __('general.common.dismiss') }}',
                            actionTextColor: '#3b3f5c'
                        });
                    }
                });
            }
        })
    }
</script>