@if(session()->has('warning'))
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
            Swal.fire({
                title: '<strong>Warning!</strong>',
                type: 'warning',
                html: '<p style="font-size:1.5em"> {{session()->get('warning')}} </p>',
                timer:1500,
                position: 'center'
            })
        });
</script>
@endif