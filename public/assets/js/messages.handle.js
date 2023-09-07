$( document ).ready(function() {
    $("#send_message_btn").on("click", function (e) {
        const message = $("#message_input").val();
        if(message != "") {
            $.post(urlSendMessage, { message });
            $("#message_input").val("");
        }
    });
    $('#message_input').on('keyup', function (e) {
        // 13 is enter key on keyboard 
        if (e.keyCode === 13) {
            const message = $(this).val();
            if(message != "") {
                $.post(urlSendMessage, { message });
                $(this).val("");
            }
        }
    });
    $('#create_new_channel_button').on('click', () => {
        $('#create_new_channel_modal').modal();
    });
    $('#button_add_new_member').on('click', () => {
        $('#add_new_member_modal').modal();
    });

    $('#show_list_member_channel').on('click', function () {
        $('#show_list_member_of_channel_modal').modal();
    });
    $('#button_image_upload').on('click', function () {
        $('#image_upload').click();
    });
    $('#button_attachments_upload').on('click', function () {
        $('#attachments_upload').click();
    });

    $('#image_upload').on('change', function () {
        $('#button_image_upload_loadding').removeClass('d-none');
        $('#button_image_upload').addClass('d-none');
        var formData = new FormData();
        var ins = document.getElementById('image_upload').files.length;
        for (var x = 0; x < ins; x++) {
            formData.append('images[]', document.getElementById('image_upload').files[x]);
        }
        formData.append('type', 'images');
        $.ajax({
            url: urlSendMessage,
            type: 'POST',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function (data) {
            },
            error: function (data) {
                toastr.error(data?.responseJSON?.message);
            },
            complete: function (data) {
                $('#button_image_upload_loadding').addClass('d-none');
                $('#button_image_upload').removeClass('d-none');
            },
        });
    });
    $('#attachments_upload').on('change', function () {
        $('#button_attachments_upload_loadding').removeClass('d-none');
        $('#button_attachments_upload').addClass('d-none');
        var formData = new FormData();
        var ins = document.getElementById('attachments_upload').files.length;
        for (var x = 0; x < ins; x++) {
            formData.append('attachments[]', document.getElementById('attachments_upload').files[x]);
        }
        formData.append('type', 'attachments');
        $.ajax({
            url: urlSendMessage,
            type: 'POST',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function (data) {
            },
            error: function (data) {
                toastr.error(data?.responseJSON?.message);
            },
            complete: function (data) {
                $('#button_attachments_upload_loadding').addClass('d-none');
                $('#button_attachments_upload').removeClass('d-none');
            },
        });
    });
});
