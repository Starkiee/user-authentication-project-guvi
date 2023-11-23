function registerUser() {
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "php/register.php",
        data: { username: username, password: password },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                window.location.href = "login.html";
            } else {
                alert("Registration failed. Please try again.");
            }
        },
        error: function (error) {
            console.log("Error:", error);
            alert("An error occurred. Please try again later.");
        }
    });
}