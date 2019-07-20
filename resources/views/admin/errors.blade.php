@if($errors->any())
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            Swal.fire({
                title: '<strong>Validation <u>failed</u></strong>',
                type: 'error',
                html: jQuery('#error-modal').html(),
                width:'50em',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'OK',
                timer:4000
            })
        });
    </script>

    <div id="error-modal" style="display: none;">
        <ul style="list-style: none">
            @foreach($errors->all() as $error)
                <li style="font-size: 1.5em; color: red">{{$error}}</li>
            @endforeach
        </ul>
    </div>

@endif
