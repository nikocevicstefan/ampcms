@if(session()->has('success'))
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            Swal.fire({
                title: '<strong>Success! </strong>',
                type: 'success',
                html: '<p style="font-size:1.5em"> {{session()->get('success')}} </p>',
                width:'50em',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'OK',
                timer:4000,
                position: 'top-end'
            })
        });
    </script>
@endif
