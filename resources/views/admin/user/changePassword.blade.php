<div class="modal" tabindex="-1" role="dialog" id="change-password-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-change-password" role="form" method="POST" action="/admin/users/{{auth()->id()}}/change-password" novalidate class="form-horizontal">
                    @method('PATCH')
                    @csrf
                    <div class="col-md-9">
                        <label for="current_password" class="col-sm-4 control-label">Current Password</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password">
                            </div>
                        </div>
                        <label for="password" class="col-sm-4 control-label">New Password</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-6">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update Password</button>
                </form>
            </div>
            <div class="modal-footer">
                {{--empty--}}
            </div>
        </div>
    </div>
</div>
