<script>
    @if(Session::has('message'))
        let type = "{{ Session::get('message')['type'] }}";
        switch (type) {
            case 'info':
                toastr.info("{!! Session::get('message')['message'] !!}");
                break;
            case 'warning':
                toastr.warning("{!! Session::get('message')['message'] !!}");
                break;
            case 'success':
                toastr.success("{!! Session::get('message')['message'] !!}");
                break;
            case 'error':
                toastr.error("{!! Session::get('message')['message'] !!}");
                break;
        }
    @endif
</script>
