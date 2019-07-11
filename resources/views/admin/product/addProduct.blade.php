<div class="modal" tabindex="-1" role="dialog" id="add-product-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/admin/products">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <input type="text" class="form-control" name="short_description" id="short_description"
                               placeholder="Enter Product Short Description">
                    </div>
                    <div class="form-group">
                        <label for="long_description">Main Description</label>
                        <textarea class="form-control" id="long_description" name="long_description"
                                  placeholder="Enter Product Main Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cover_photo">Cover Photo</label>
                        <input type="text" id="cover_photo" name="cover_photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alt_tag">Alt Tag</label>
                        <input type="text" class="form-control" id="alt_tag" placeholder="alt tag"
                               name="alt_tag">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="text" id="thumbnail" name="thumbnail" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
            <div class="modal-footer">
{{--                EMPTY--}}
            </div>
        </div>
    </div>
</div>
