var pageTitle = $('title').text();
$("#page-title").text(pageTitle);

//change password
$("#changePassBtn").on("click", function () {
    var oldPassword = $("#oldPassword").val();
    var newPassword = $("#newPassword").val();
    var confPassword = $("#confPassword").val();
    var type = "changeModeratorPass";
    var valid = true;

    if (oldPassword === "") {
        valid = false;
    }

    if (newPassword === "") {
        valid = false;
    }

    if (confPassword === "") {
        valid = false;
    }

    if (newPassword !== confPassword) {
        valid = false;
    }

    if (valid === false) {
        $.notify({
            icon: 'pe-7s-gift',
            message: "Something is wrong."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/AsyncScript.php",
            type: "POST",
            data: {
                oldPass: oldPassword,
                newPass: newPassword,
                confPass: confPassword,
                type: type
            },
            dataType: "json",
            success: function (response) {
                //alert("Successfully submitted.");
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Password Changed Successfully!"

                }, {
                    type: 'success',
                    timer: 500
                });

                //location.reload(true);
                $("#oldPassword").val("");
                $("#newPassword").val("");
                $("#confPassword").val("");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.notify({
                    icon: 'pe-7s-gift',
                    message: thrownError

                }, {
                    type: 'danger',
                    timer: 500
                });
            }
        });
    }
});

var uploader = new qq.FineUploader({
    element: document.getElementById("fine-uploader"),
    request: {
        endpoint: "/assets/php/endpoint.php",
        params: {
            uploadFor: "moderator-profile-pic"
        }
    },
    deleteFile: {
        enabled: false,
        forceConfirm: true,
        endpoint: "/assets/php/endpoint.php"
    },
    resume: {
        enabled: false
    },
    autoUpload: false,
    retry: {
        enableAuto: true,
        showButton: true
    },
    validation: {
        allowedExtensions: ['jpeg', 'jpg', 'png'],
        itemLimit: 1,
        sizeLimit: 100000 // 100Kb
    },
    callbacks: {
        onError: function (id, name, errorReason, xhrOrXdr) {
            alert(qq.format("Error on file number {} - {}.  Reason: {}", id, name, errorReason));
        },
        onComplete: function (id, name, responseJSON, xhr) {
            if (responseJSON.success === true) {
                var url = responseJSON.uuid + "/" + responseJSON.uuid + "." + responseJSON.ext + "";
                var type = "saveModeratorImageLink";
                var valid = true;

                if (url === "") {
                    valid = false;
                }

                if (valid === false) {
                    $.notify({
                        icon: 'pe-7s-gift',
                        message: "You are not allowed to perform such operation"

                    }, {
                        type: 'danger',
                        timer: 500
                    });
                } else {
                    $.ajax({
                        url: "/assets/php/AsyncScript.php",
                        type: "POST",
                        data: {url: url, type: type},
                        success: function (response) {
                            $.notify({
                                icon: 'pe-7s-gift',
                                message: "Profile Picture Uploaded."

                            }, {
                                type: 'info',
                                timer: 500
                            });

                            location.reload(true);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $.notify({
                                icon: 'pe-7s-gift',
                                message: thrownError

                            }, {
                                type: 'danger',
                                timer: 500
                            });
                        }
                    });
                }
            }
        }
    }
});

qq(document.getElementById("trigger-upload")).attach("click", function () {
    uploader.uploadStoredFiles();
});