function loginUser() {
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
        type: "POST",
        url: "login.php",
        data: { username: username, password: password },
        dataType: "json",
        success: function (response) {
            if (response.sessionId) {
                localStorage.setItem("sessionId", response.sessionId);

                window.location.href = "profile.html";
            } else {
                alert("Invalid login credentials. Please try again.");
            }
        },
        error: function () {
            alert("Error during login. Please try again.");
        }
    });
}