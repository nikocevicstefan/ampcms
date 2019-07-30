<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm Action</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to proceed?
            </div>
            <div class="modal-footer">
                <form id="userForm" action="#" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id">
                    <a class="btn btn-danger" href="" id="cancelButton">Yes</a>
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#cancelModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            $('#cancelButton').attr("href",url);
        })
    })
</script>