<div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('author.new_author_add')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="full_name">@lang('author.full_name')</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Ad Soyad">
                    <p style="color: #ff4747;display: none;" class="error-full_name"></p>
                </div>
                <div class="form-group">
                    <label for="birth_date">@lang('author.birth_date')</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                </div>
                <div class="form-group">
                    <label for="death_date">@lang('author.death_date')</label>
                    <input type="date" class="form-control" id="death_date" name="death_date">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="authorAdd"><i class="mdi mdi-plus"></i></button>
            </div>
        </div>
    </div>
</div>
