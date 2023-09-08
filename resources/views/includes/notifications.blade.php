@if (session()->has(NOTIFICATION_SUCCESS))
    <script>
        Snackbar.show({
            text: '{{ session()->get(NOTIFICATION_SUCCESS) }}',
            textColor: '#ddf5f0',
            backgroundColor: '#00ab55',
            actionText: '{{ __('general.common.dismiss') }}',
            actionTextColor: '#3b3f5c'
        });
    </script>
@endif

@if (session()->has(NOTIFICATION_ERROR))
    <script>
        Snackbar.show({
            text: '{{ session()->get(NOTIFICATION_ERROR) }}',
            textColor: '#fbeced',
            backgroundColor: '#e7515a',
            actionText: '{{ __('general.common.dismiss') }}',
            actionTextColor: '#3b3f5c'
        });
    </script>
@endif
