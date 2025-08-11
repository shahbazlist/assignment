// $(document).on("click", ".inviteClient", function() {
    function inviteClient(url){
        $(".error").html('');

        if ($("#name").val().trim() == "") {
            $("#error-name").html('Name field is require.');
            return false;
        }
        if ($("#email").val().trim() == 0) {
            $("#error-email").html('Email field is require.');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: $("#newClientForm").serialize(),
            beforeSend: function() {
                $(".loaderBtn").html(
                    '<button type="button" class="btn btn-success">Send Invitation....</button>'
                );
            },
            success: function(response) {
                $(".loaderBtn").html(
                    '<button type="button" class="btn btn-success" onclick="inviteClient(\'' + url + '\')" >Send Invitation</button>'
                );
                if (response.status == true) {
                    $("#newClientForm")[0].reset();
                    $('#newClient').modal('hide');
                    $(".success-message").show();
                    $(".success-message").html(response.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 4000);
                } else {
                    $(".error-message").show();
                    $(".error-message").html(response.message);
                }

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $(".loaderBtn").html(
                        '<button type="button" class="btn btn-success" onclick="inviteClient(\'' + url + '\')" >Send Invitation</button>'
                    );
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        $("#error-" + key).html(messages[0]);
                    });
                }
            }
        });
    }

    function newShortUrl(url){
        $(".error").html('');

        if ($("#url").val().trim() == "") {
            $("#error-url").html('URL field is require.');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "POST",
            data: $("#newShortUrlForm").serialize(),
            beforeSend: function() {
                $(".loaderBtn").html(
                    '<button type="button" class="btn btn-success">Generate....</button>');
            },
            success: function(response) {
                $(".loaderBtn").html(
                    '<button type="button" class="btn btn-success" onclick="newShortUrl(\'' + url + '\')">Generate</button>'
                );
                if (response.status == true) {
                    $("#newShortUrlForm")[0].reset();
                    $('#newShortUrl').modal('hide');
                    $(".success-message").show();
                    $(".success-message").html(response.message);
                    setTimeout(function() {
                        window.location.reload();
                    }, 4000);
                } else {
                    $(".error-message").show();
                    $(".error-message").html(response.message);
                }

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $(".loaderBtn").html(
                        '<button type="button" class="btn btn-success" onclick="newShortUrl(\'' + url + '\')">Generate</button>'
                    );
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        $("#error-" + key).html(messages[0]);
                    });
                }
            }
        });
    }


    $('#url_filter').on('change', function() {
        var filter = $(this).val();
        window.location.href = '?filter=' + filter;
    });