<div class="modal fade" id="newClient" tabindex="-1" aria-labelledby="newClientLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="newClientForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="newClientLabel">Invite New Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"> Name <small class="text-danger">*</small></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Client name...">
                            <div class="text-danger error" id="error-name"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="ex.john@gmail.com">
                            <div class="text-danger error" id="error-email"></div>
                        </div>
                        @if(isset($roles) && $roles)
                        <div class="mb-3" style="display: {{isset($roles) && $roles ?? none}}">
                            <label class="form-label">Role <small class="text-danger">*</small></label>
                            <select name="role" class="form-control">
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}">
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <div class="loaderBtn">
                            <button type="button" class="btn btn-success" onclick="inviteClient('{{ route('dashboard.inviteclient') }}')">Send Invitation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>