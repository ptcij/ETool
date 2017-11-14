/*
 *
 * login js script
 * Autor: Faruk Nasir
 * twitter: http://twitter.com/frknasir
 * 
 */

$("#loginBtn").on("click", function () {
    //initialize variables
    var email = $("#email").val();
    var password = $("#password").val();
    var type = "loginCitizen";
    var valid = true;

    if (email === "") {
        valid = false;
        $.notify({
            icon: 'pe-7s-gift',
            message: "Email can not be empty."

        }, {
            type: 'warning',
            timer: 500
        });
    }

    if (password === "") {
        valid = false;
        $.notify({
            icon: 'pe-7s-gift',
            message: "Password can not be empty."

        }, {
            type: 'warning',
            timer: 500
        });
    }

    if (valid === false) {
        //do something here
    } else {
        $.ajax({
            url: "/assets/php/Auth.php/",
            type: "POST",
            data: {
                email: email,
                password: password,
                type: type
            },
            dataType: "json",
            beforeSend: function () {

            },
            success: function (response) {
                //location.reload(true);
                window.location.replace("/timeline/");
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