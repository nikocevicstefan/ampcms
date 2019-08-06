<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('sentence.delete')</h4>
            </div>
            <div class="modal-body">
                {{__('Are you sure?')}}
            </div>
            <div class="modal-footer">
                <form id="userForm" action="#" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('sentence.close')</button>
                    <button type="submit" class="btn btn-danger">@lang('sentence.delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var route = button.data('route');
            $('#userForm').attr("action", "/admin/" + route + "/" + id );
        })
    })
</script>
