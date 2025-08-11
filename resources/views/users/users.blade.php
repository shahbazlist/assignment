<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    https://laraveldaily.com/post/laravel-service-classes-injection
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-4">
                {{-- <h1 class="text-2xl font-bold mb-4">Clients</h1> --}}
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold">Clients</h1>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newClient">
                        + New
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newShortUrl">
                        + ShortURL
                    </button>
                </div>
                <div class="alert alert-success success-message" role="alert" style="display: none"></div>
                <div class="alert alert-danger error-message" role="alert" style="display: none"></div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Client Name</th>
                            <th class="border px-4 py-2">Users</th>
                            <th class="border px-4 py-2">Total Generate URLs</th>
                            <th class="border px-4 py-2">Total URL Hits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->name }}<br><small>{{ $user->email }}</small></td>
                            <td class="border px-4 py-2">{{count($user->children)}}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">20</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ 'Showing ' . $result->lastItem() . ' of total ' . $result->total() }} <a href="{{ route('dashboard', 'all-clients') }}" class="btn btn-success">View All</a>

            </div>
        </div>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-bold mb-4">Generated Short URLs</h1>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Short URL</th>
                                <th class="border px-4 py-2">Long URL</th>
                                <th class="border px-4 py-2">Hits</th>
                                <th class="border px-4 py-2">Client Name</th>
                                <th class="border px-4 py-2">Created On</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($urls as $url)
                            <tr>
                                <td class="border px-4 py-2">{{ url('').'/'.$url->token }}</td>
                                <td class="border px-4 py-2">{{ $url->url }}</td>
                                <td class="border px-4 py-2">{{ $url->hits }}</td>
                                <td class="border px-4 py-2">{{ $url->user->name}}</td>
                                <td class="border px-4 py-2">{{ date("d M 'y", strtotime($url->created_at)) }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ 'Showing ' . $urls->lastItem() . ' of total ' . $urls->total() }} <a href="{{ route('dashboard', 'all-url') }}" class="btn btn-success">View All</a>

                </div>
            </div>
        </div>
        {{-- Modal Popup Start --}}
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
                                <input type="text" name="name" id="name" class="form-control" placeholder="Client name..." >
                                <div class="text-danger error" id="error-name"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email <small class="text-danger">*</small></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="ex.john@gmail.com" >
                                <div class="text-danger error" id="error-email"></div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <div class="loaderBtn">
                                <button type="button" class="btn btn-success inviteClient">Send Invitation</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="newShortUrl" tabindex="-1" aria-labelledby="newClientLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="newShortUrlForm">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="newClientLabel">Generate Short URL</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label"> URL <small class="text-danger">*</small></label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="eg. https://www.google.com/" >
                                <div class="text-danger error" id="error-url"></div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <div class="loaderBtn">
                                <button type="button" class="btn btn-success createShortUrl">Generate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Popup End --}}
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("click", ".inviteClient", function () {
        $(".error").html('');
        
        if($("#name").val().trim() == ""){
            $("#error-name").html('Name field is require.');
            return false;
        }
        if($("#email").val().trim() == 0){
            $("#error-email").html('Email field is require.');
            return false;
        }
        
        var url = "{{route('dashboard.inviteclient')}}";
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url:url,
            type: "POST",
            data: $("#newClientForm").serialize(),
            beforeSend: function() {
                $(".loaderBtn").html('<button type="button" class="btn btn-success">Send Invitation....</button>');
            },
            success: function (response) {
                $(".loaderBtn").html('<button type="button" class="btn btn-success inviteClient">Send Invitation</button>'); 
                if(response.status == true){
                    $("#newClientForm")[0].reset();
                    $('#newClient').modal('hide');
                    $(".success-message").show();
                    $(".success-message").html(response.message);
                    setTimeout(function(){
                        window.location.reload();
                    }, 4000);
                }else{
                    $(".error-message").show();
                    $(".error-message").html(response.message);
                }
                
            }
        });
    });

    $(document).on("click", ".createShortUrl", function () {
        $(".error").html('');
        
        if($("#url").val().trim() == ""){
            $("#error-url").html('URL field is require.');
            return false;
        }
        
        var url = "{{route('create_shorturl')}}";
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url:url,
            type: "POST",
            data: $("#newShortUrlForm").serialize(),
            beforeSend: function() {
                $(".loaderBtn").html('<button type="button" class="btn btn-success">Generate....</button>');
            },
            success: function (response) {
                $(".loaderBtn").html('<button type="button" class="btn btn-success createShortUrl">Generate</button>'); 
                alert(response.status);
                if(response.status == true){
                    $("#newShortUrlForm")[0].reset();
                    $('#newShortUrl').modal('hide');
                    $(".success-message").show();
                    $(".success-message").html(response.message);
                    setTimeout(function(){
                        window.location.reload();
                    }, 4000);
                }else{
                    $(".error-message").show();
                    $(".error-message").html(response.message);
                }
                
            }
        });
    });
</script>
