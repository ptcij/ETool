/*
 *
 * register js script
 * Autor: Faruk Nasir
 * twitter: http://twitter.com/frknasir
 * 
 */

$("#registerBtn").on("click", function (e) {
    e.preventDefault();
    //initialize variables
    var name = $("#name").val();
    var email = $("#email").val();
    var localGov = $("#localGov").val();
    var password = $("#password").val();
    var cpassword = $("#cpassword").val();
    var type = "registerCitizen";
    var valid = true;

    if (name === "" || email === "" || localGov === "" || password === "" || cpassword === "") {
        valid = false;
    }

    if (password !== cpassword) {
        valid = false;
    }

    if (valid === false) {
        //do something here
        $.notify({
            icon: 'pe-7s-gift',
            message: "Check the fields and try again."

        }, {
            type: 'danger',
            timer: 500
        });
    } else {
        $.ajax({
            url: "/assets/php/Auth.php/",
            type: "POST",
            data: {
                name: name,
                email: email,
                localGov: localGov,
                password: password,
                cpassword: cpassword,
                type: type
            },
            dataType: "json",
            beforeSend: function () {

            },
            success: function (response) {
                //location.reload(true);
                window.location.replace("/login/?sr=1");
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