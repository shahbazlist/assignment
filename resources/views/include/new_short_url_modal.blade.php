<div class="modal fade" id="newShortUrl" tabindex="-1" aria-labelledby="newClientLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="newShortUrlForm">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="newClientLabel">Generate Short URL</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"> URL <small class="text-danger">*</small></label>
                            <input type="text" name="url" id="url" class="form-control"
                                placeholder="eg. https://www.google.com/">
                            <div class="text-danger error" id="error-url"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <div class="loaderBtn">
                            <button type="button" class="btn btn-success createShortUrl" onclick="newShortUrl('{{ route('create_shorturl') }}')">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>