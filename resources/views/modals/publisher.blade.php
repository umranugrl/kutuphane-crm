<div class="modal fade" id="publisherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('publisher.new_publisher_add')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="publisher_name">@lang('publisher.publisher_name')</label>
                    <input type="text" class="form-control" id="publisher_name" name="publisher_name"
                        placeholder="Yayın Evi">
                    <p style="color: #ff4747;display: none;" class="error-publisher_name"></p>
                </div>
                <div class="form-group">
                    <label for="address">@lang('publisher.address')</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Adres"></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">@lang('publisher.phone')</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon">
                </div>
                <div class="form-group">
                    <label for="website">@lang('publisher.website')</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder="Web Site">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="publisherAdd"><i class="mdi mdi-plus"></i></button>
            </div>
        </div>
    </div>
</div>
