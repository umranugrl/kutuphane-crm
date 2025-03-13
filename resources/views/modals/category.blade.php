<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('category.new_category_add')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="category_name">@lang('category.category_name')</label>
                    <input type="text" class="form-control" name="category_name" id="category_name"
                        placeholder="Kategori Adı">
                    <p style="color: #ff4747;display: none;" class="error-category_name"></p>
                </div>
                <div class="form-group">
                    <label for="description">@lang('category.description')</label>
                    <input type="text" class="form-control" name="description" placeholder="Açıklama">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="categoryAdd"><i
                        class="mdi mdi-plus"></i></button>
            </div>
        </div>
    </div>
</div>
